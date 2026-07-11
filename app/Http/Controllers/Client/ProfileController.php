<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user()->load('profile');
        return view('client.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'timezone' => 'nullable|string|max:255',
        ]);

        $user->update($request->only(['name', 'email', 'phone']));

        $profileData = $request->only(['company', 'website', 'bio', 'address', 'city', 'state', 'zip', 'country', 'timezone']);
        if ($user->profile) {
            $user->profile->update($profileData);
        } else {
            $user->profile()->create($profileData);
        }

        return back()->with('success', 'Profile updated successfully.');
    }

    public function showPasswordForm()
    {
        return view('client.change-password');
    }

    public function generateApiToken()
    {
        $user = auth()->user();
        $plainToken = Str::random(60);
        $user->update(['api_token' => hash('sha256', $plainToken)]);

        return back()->with('api_token', $plainToken)->with('success', 'API token generated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password changed successfully.');
    }
}
