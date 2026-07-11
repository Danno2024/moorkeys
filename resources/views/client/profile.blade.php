@extends('client.layouts.app')
@section('title', 'Profile')
@section('content')
<div class="mb-6"><h1 class="text-2xl font-bold text-gray-900">My Profile</h1></div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl mb-6">
    <h2 class="text-lg font-bold text-gray-900 mb-6">Profile Information</h2>
    <form method="POST" action="{{ route('client.profile.update') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Name</label><input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Phone</label><input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Company</label><input type="text" name="company" value="{{ old('company', $user->profile->company ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Website</label><input type="text" name="website" value="{{ old('website', $user->profile->website ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Timezone</label><select name="timezone" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">@foreach(timezone_identifiers_list() as $tz)<option value="{{ $tz }}" {{ ($user->profile->timezone ?? 'UTC') === $tz ? 'selected' : '' }}>{{ $tz }}</option>@endforeach</select></div>
            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Bio</label><textarea name="bio" rows="3" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('bio', $user->profile->bio ?? '') }}</textarea></div>
        </div>
        <div class="flex items-center justify-end gap-3 mt-6">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Update Profile</button>
        </div>
    </form>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl mb-6">
    <h2 class="text-lg font-bold text-gray-900 mb-6">API Access</h2>
    <p class="text-sm text-gray-600 mb-4">Use this token to authenticate your application with the MoorKeys Validation API.</p>
    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 mb-4">
        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Your API Token</label>
        @if(session('api_token'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-3">
                <p class="text-xs text-green-700 font-medium mb-1">Token generated! Copy it now — it won't be shown again.</p>
                <code class="block text-sm font-mono bg-white border border-green-300 rounded px-3 py-2 break-all text-gray-900">{{ session('api_token') }}</code>
            </div>
        @else
            <code class="block text-sm font-mono bg-white border border-gray-300 rounded px-3 py-2 text-gray-400">••••••••••••••••••••••••••••••••••••••••••••</code>
            <p class="text-xs text-gray-400 mt-1">Token is hidden for security. Generate a new one to see it.</p>
        @endif
    </div>
    <form method="POST" action="{{ route('client.profile.api-token') }}">
        @csrf
        <button type="submit" class="px-4 py-2 {{ $user->api_token ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-indigo-600 hover:bg-indigo-700' }} text-white rounded-lg text-sm">{{ $user->api_token ? 'Regenerate Token' : 'Generate Token' }}</button>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">
    <h2 class="text-lg font-bold text-gray-900 mb-6">Change Password</h2>
    <form method="POST" action="{{ route('client.password.update') }}">
        @csrf
        <div class="grid grid-cols-1 gap-4 mb-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label><input type="password" name="current_password" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">New Password</label><input type="password" name="password" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label><input type="password" name="password_confirmation" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
        </div>
        <div class="flex items-center justify-end gap-3 mt-6">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Change Password</button>
        </div>
    </form>
</div>
@endsection
