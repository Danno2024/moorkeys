<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
        } catch (\UnexpectedValueException) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $session = $event->data->object ?? null;

        switch ($event->type) {
            case 'checkout.session.completed':
                $this->handleCheckoutCompleted($session);
                break;

            case 'customer.subscription.updated':
            case 'customer.subscription.created':
                $this->handleSubscriptionUpdated($session);
                break;

            case 'customer.subscription.deleted':
                $this->handleSubscriptionDeleted($session);
                break;

            case 'invoice.paid':
                $this->handleInvoicePaid($session);
                break;

            case 'invoice.payment_failed':
                $this->handleInvoicePaymentFailed($session);
                break;
        }

        return response()->json(['status' => 'ok']);
    }

    protected function handleCheckoutCompleted($session)
    {
        $userId = $session->metadata->user_id ?? null;
        $planId = $session->metadata->plan_id ?? null;
        $stripeSubId = $session->subscription ?? null;

        if (! $userId || ! $planId || ! $stripeSubId) {
            return;
        }

        $user = User::find($userId);
        $plan = Plan::find($planId);

        if (! $user || ! $plan) {
            return;
        }

        if ($user->stripe_customer_id !== $session->customer) {
            $user->update(['stripe_customer_id' => $session->customer]);
        }

        // Cancel any existing active subscriptions
        Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->update(['status' => 'cancelled', 'cancelled_at' => now()]);

        Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'status' => 'active',
            'stripe_subscription_id' => $stripeSubId,
            'stripe_status' => 'active',
            'starts_at' => now(),
        ]);
    }

    protected function handleSubscriptionUpdated($subscription)
    {
        $sub = Subscription::where('stripe_subscription_id', $subscription->id)->first();

        if (! $sub) {
            return;
        }

        $stripeStatus = $subscription->status;
        $localStatus = match ($stripeStatus) {
            'active', 'trialing' => 'active',
            'past_due' => 'past_due',
            'canceled', 'unpaid', 'incomplete_expired' => 'cancelled',
            default => $sub->status,
        };

        $sub->update([
            'status' => $localStatus,
            'stripe_status' => $stripeStatus,
            'ends_at' => $subscription->current_period_end
                ? now()->timestamp($subscription->current_period_end)
                : $sub->ends_at,
        ]);
    }

    protected function handleSubscriptionDeleted($subscription)
    {
        $sub = Subscription::where('stripe_subscription_id', $subscription->id)->first();

        if ($sub) {
            $sub->update([
                'status' => 'cancelled',
                'stripe_status' => 'canceled',
                'cancelled_at' => now(),
            ]);
        }
    }

    protected function handleInvoicePaid($invoice)
    {
        $subId = $invoice->subscription;
        if (! $subId) {
            return;
        }

        $sub = Subscription::where('stripe_subscription_id', $subId)->first();

        if ($sub) {
            $sub->update([
                'status' => 'active',
                'stripe_status' => 'active',
                'ends_at' => $invoice->lines->data[0]->period->end ?? null
                    ? now()->timestamp($invoice->lines->data[0]->period->end)
                    : $sub->ends_at,
            ]);
        }
    }

    protected function handleInvoicePaymentFailed($invoice)
    {
        $subId = $invoice->subscription;
        if (! $subId) {
            return;
        }

        $sub = Subscription::where('stripe_subscription_id', $subId)->first();

        if ($sub) {
            $sub->update([
                'stripe_status' => 'past_due',
            ]);
        }
    }
}
