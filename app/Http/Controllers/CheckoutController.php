<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function session(Request $request, Plan $plan)
    {
        if (! $plan->is_active || ! $plan->stripe_price_id) {
            return back()->with('error', 'This plan is not available for checkout.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $user = $request->user();

        $customerId = $user->stripe_customer_id;

        if (! $customerId) {
            $customer = \Stripe\Customer::create([
                'email' => $user->email,
                'name' => $user->name,
                'metadata' => ['user_id' => $user->id],
            ]);
            $customerId = $customer->id;
            $user->update(['stripe_customer_id' => $customerId]);
        }

        $session = Session::create([
            'customer' => $customerId,
            'mode' => 'subscription',
            'line_items' => [[
                'price' => $plan->stripe_price_id,
                'quantity' => 1,
            ]],
            'success_url' => route('client.dashboard') . '?subscription=success',
            'cancel_url' => route('home') . '#pricing',
            'metadata' => [
                'plan_id' => $plan->id,
                'user_id' => $user->id,
            ],
        ]);

        return redirect($session->url);
    }

    public function portal(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $user = $request->user();

        if (! $user->stripe_customer_id) {
            return back()->with('error', 'No active subscription found.');
        }

        $session = \Stripe\BillingPortal\Session::create([
            'customer' => $user->stripe_customer_id,
            'return_url' => route('client.dashboard'),
        ]);

        return redirect($session->url);
    }
}
