<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ActivationKey;
use App\Models\Plan;
use App\Services\KeyGeneratorService;
use Illuminate\Http\Request;

class ActivationKeyController extends Controller
{
    protected KeyGeneratorService $keyGenerator;

    public function __construct(KeyGeneratorService $keyGenerator)
    {
        $this->keyGenerator = $keyGenerator;
    }

    public function index(Request $request)
    {
        $query = auth()->user()->activationKeys();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('key', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%")
                  ->orWhere('client_email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $keys = $query->with('plan', 'owner')->latest()->paginate(15);
        return view('client.keys.index', compact('keys'));
    }

    public function create()
    {
        $plans = Plan::where('is_active', true)->get();
        $user = auth()->user();
        $subscription = $user->activeSubscription;
        $keyCount = $user->activationKeys()->count();
        $maxKeys = $subscription?->plan->max_keys ?? 0;

        if ($maxKeys > 0 && $keyCount >= $maxKeys) {
            return redirect()->route('client.keys.index')
                ->with('error', 'You have reached your key limit. Please upgrade your plan.');
        }

        return view('client.keys.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $subscription = $user->activeSubscription;
        $maxKeys = $subscription?->plan->max_keys ?? 0;
        $keyCount = $user->activationKeys()->count();

        if ($maxKeys > 0 && $keyCount >= $maxKeys) {
            return back()->with('error', 'Key limit reached.');
        }

        $data = $request->validate([
            'plan_id' => 'nullable|exists:plans,id',
            'client_name' => 'nullable|string|max:255',
            'client_email' => 'nullable|email|max:255',
            'domain' => 'nullable|string|max:255',
            'product_type' => 'required|in:web,desktop,mobile,api,other',
            'expires_at' => 'nullable|date',
        ]);

        $data['user_id'] = $user->id;
        $data['key'] = $this->keyGenerator->generate();
        $data['status'] = 'active';
        $data['activated_at'] = now();

        $key = ActivationKey::create($data);

        return redirect()->route('client.keys.index')->with('success', 'Key created: ' . $key->key);
    }

    public function show(ActivationKey $activationKey)
    {
        if ($activationKey->user_id !== auth()->id()) {
            abort(403);
        }
        $activationKey->load('plan', 'owner', 'events');
        return view('client.keys.show', compact('activationKey'));
    }

    public function edit(ActivationKey $activationKey)
    {
        if ($activationKey->user_id !== auth()->id()) {
            abort(403);
        }
        $plans = Plan::where('is_active', true)->get();
        return view('client.keys.edit', compact('activationKey', 'plans'));
    }

    public function update(Request $request, ActivationKey $activationKey)
    {
        if ($activationKey->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'plan_id' => 'nullable|exists:plans,id',
            'client_name' => 'nullable|string|max:255',
            'client_email' => 'nullable|email|max:255',
            'domain' => 'nullable|string|max:255',
            'product_type' => 'required|in:web,desktop,mobile,api,other',
        ]);

        $activationKey->update($data);

        return redirect()->route('client.keys.index')->with('success', 'Key updated successfully.');
    }

    public function revoke(ActivationKey $activationKey)
    {
        if ($activationKey->user_id !== auth()->id()) {
            abort(403);
        }
        $activationKey->update(['status' => 'revoked']);
        return back()->with('success', 'Key revoked successfully.');
    }
}
