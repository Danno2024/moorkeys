<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('profile')->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:super_admin,client',
            'is_active' => 'boolean',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = $request->boolean('is_active', true);

        $user = User::create($data);

        $user->profile()->create($request->only([
            'company', 'website', 'bio', 'address', 'city', 'state', 'zip', 'country', 'timezone'
        ]));

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $user->load('profile');
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:super_admin,client',
            'is_active' => 'boolean',
            'two_factor_enabled' => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['two_factor_enabled'] = $request->boolean('two_factor_enabled');

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if ($user->profile) {
            $user->profile->update($request->only([
                'company', 'website', 'bio', 'address', 'city', 'state', 'zip', 'country', 'timezone'
            ]));
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function generateApiToken(User $user)
    {
        $plainToken = Str::random(60);
        $user->update(['api_token' => hash('sha256', $plainToken)]);

        return back()->with('api_token', $plainToken)->with('success', 'API token generated for ' . $user->name . '.');
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin() && User::where('role', 'super_admin')->count() <= 1) {
            return back()->with('error', 'Cannot delete the last super admin.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
