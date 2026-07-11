<?php

namespace App\Http\Controllers;

use App\Models\ActivationKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function showRegisterForm()
    {
        return view('customer.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'claim_key' => 'nullable|string|exists:activation_keys,key',
        ]);

        $user = \App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'end_user',
            'is_active' => true,
        ]);

        if (!empty($data['claim_key'])) {
            ActivationKey::where('key', $data['claim_key'])
                ->whereNull('owner_id')
                ->update(['owner_id' => $user->id]);
        }

        auth()->login($user);

        return redirect()->route('customer.dashboard')->with('success', 'Account created! Welcome to the License Portal.');
    }

    public function dashboard()
    {
        $user = auth()->user();
        $claimedKeys = $user->claimedKeys()
            ->with(['plan:id,name', 'user:id,name,email'])
            ->latest()
            ->get();

        return view('customer.dashboard', compact('claimedKeys'));
    }

    public function claim(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|exists:activation_keys,key',
        ]);

        $activationKey = ActivationKey::where('key', $data['key'])->first();

        if ($activationKey->owner_id !== null) {
            return back()->withErrors(['key' => 'This license key has already been claimed.']);
        }

        $activationKey->update(['owner_id' => auth()->id()]);

        return back()->with('success', 'License key claimed successfully!');
    }

    public function unclaim(ActivationKey $activationKey)
    {
        abort_if($activationKey->owner_id !== auth()->id(), 403);

        $activationKey->update(['owner_id' => null]);

        return back()->with('success', 'License key removed from your account.');
    }
}
