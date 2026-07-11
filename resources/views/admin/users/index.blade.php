@extends('admin.layouts.app')
@section('title', 'Users')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div><h1 class="text-2xl font-bold text-gray-900">Users</h1><p class="text-gray-600 mt-1">Manage all users.</p></div>
    <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Add User</a>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead><tr class="bg-gray-50 border-b border-gray-200">
                <th class="text-left px-6 py-3 font-medium text-gray-600">Name</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Email</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Role</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Status</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">2FA</th>
                <th class="text-right px-6 py-3 font-medium text-gray-600">Actions</th>
            </tr></thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center text-sm font-medium">{{ substr($user->name, 0, 2) }}</div>
                            <span class="font-medium text-gray-900">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $user->role === 'super_admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700' }}">{{ str_replace('_', ' ', $user->role) }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($user->two_factor_enabled)
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">Enabled</span>
                        @else
                            <span class="text-xs text-gray-400">Disabled</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">{{ $users->links() }}</div>
</div>
@endsection
