@extends('admin.layouts.app')
@section('title', 'Edit User')
@section('content')
<div class="mb-6"><a href="{{ route('admin.users.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Users</a></div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">
    <h2 class="text-xl font-bold text-gray-900 mb-6">Edit User: {{ $user->name }}</h2>
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Name</label><input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">New Password</label><input type="password" name="password" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Leave blank to keep"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label><input type="password" name="password_confirmation" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Role</label><select name="role" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Client</option><option value="super_admin" {{ $user->role === 'super_admin' ? 'selected' : '' }}>Super Admin</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Status</label><select name="is_active" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="1" {{ $user->is_active ? 'selected' : '' }}>Active</option><option value="0" {{ !$user->is_active ? 'selected' : '' }}>Inactive</option></select></div>
        </div>
        <div class="flex items-center justify-end gap-3 mt-6">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 text-sm">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Update User</button>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl mt-6">
    <h2 class="text-lg font-bold text-gray-900 mb-4">API Token</h2>
    <p class="text-sm text-gray-600 mb-4">Manage this user's API access for key validation.</p>
    @if(session('api_token'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
            <p class="text-xs text-green-700 font-medium mb-2">New token generated! Copy it now — it won't be shown again.</p>
            <code class="block text-sm font-mono bg-white border border-green-300 rounded px-3 py-2 break-all text-gray-900">{{ session('api_token') }}</code>
        </div>
    @elseif($user->api_token)
        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 mb-4">
            <code class="block text-sm font-mono text-gray-400">••••••••••••••••••••••••••••••••••••••••••••</code>
            <p class="text-xs text-gray-400 mt-1">Token exists but is hidden. Regenerate to create a new one.</p>
        </div>
    @else
        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 mb-4">
            <p class="text-sm text-gray-500">No API token set.</p>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.users.api-token', $user) }}">
        @csrf
        <button type="submit" class="px-4 py-2 {{ $user->api_token ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-indigo-600 hover:bg-indigo-700' }} text-white rounded-lg text-sm">{{ $user->api_token ? 'Regenerate Token' : 'Generate Token' }}</button>
    </form>
</div>
@endsection
