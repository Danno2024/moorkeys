<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivationKey;
use App\Models\User;
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
        $query = ActivationKey::with('user', 'plan', 'owner');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('key', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%")
                  ->orWhere('client_email', 'like', "%{$search}%")
                  ->orWhere('domain', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('product_type')) {
            $query->where('product_type', $request->product_type);
        }

        $keys = $query->latest()->paginate(15);
        return view('admin.keys.index', compact('keys'));
    }

    public function create()
    {
        $users = User::where('role', 'client')->where('is_active', true)->get();
        $plans = Plan::where('is_active', true)->get();
        return view('admin.keys.create', compact('users', 'plans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'nullable|exists:plans,id',
            'client_name' => 'nullable|string|max:255',
            'client_email' => 'nullable|email|max:255',
            'domain' => 'nullable|string|max:255',
            'product_type' => 'required|in:web,desktop,mobile,api,other',
            'expires_at' => 'nullable|date',
        ]);

        $data['key'] = $this->keyGenerator->generate();
        $data['status'] = 'active';
        $data['activated_at'] = now();

        $key = ActivationKey::create($data);

        return redirect()->route('admin.keys.index')->with('success', 'Activation key created: ' . $key->key);
    }

    public function show(ActivationKey $activationKey)
    {
        $activationKey->load('user', 'plan', 'owner', 'events');
        return view('admin.keys.show', compact('activationKey'));
    }

    public function edit(ActivationKey $activationKey)
    {
        $users = User::where('role', 'client')->where('is_active', true)->get();
        $plans = Plan::where('is_active', true)->get();
        return view('admin.keys.edit', compact('activationKey', 'users', 'plans'));
    }

    public function update(Request $request, ActivationKey $activationKey)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'nullable|exists:plans,id',
            'client_name' => 'nullable|string|max:255',
            'client_email' => 'nullable|email|max:255',
            'domain' => 'nullable|string|max:255',
            'product_type' => 'required|in:web,desktop,mobile,api,other',
            'status' => 'required|in:active,expired,revoked,suspended',
            'expires_at' => 'nullable|date',
        ]);

        $activationKey->update($data);

        return redirect()->route('admin.keys.index')->with('success', 'Key updated successfully.');
    }

    public function destroy(ActivationKey $activationKey)
    {
        $activationKey->delete();
        return redirect()->route('admin.keys.index')->with('success', 'Key deleted successfully.');
    }

    public function bulkCreate(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'nullable|exists:plans,id',
            'count' => 'required|integer|min:1|max:100',
            'product_type' => 'required|in:web,desktop,mobile,api,other',
            'expires_at' => 'nullable|date',
        ]);

        $keys = [];
        for ($i = 0; $i < $data['count']; $i++) {
            $keys[] = ActivationKey::create([
                'user_id' => $data['user_id'],
                'plan_id' => $data['plan_id'],
                'key' => $this->keyGenerator->generate(),
                'product_type' => $data['product_type'],
                'status' => 'active',
                'activated_at' => now(),
                'expires_at' => $data['expires_at'] ?? null,
            ]);
        }

        return redirect()->route('admin.keys.index')->with('success', "{$data['count']} keys created successfully.");
    }
}
