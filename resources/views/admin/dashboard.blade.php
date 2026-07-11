@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600 mt-1">Overview of your MoorKeys system.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total_users'] }}</p>
                </div>
                <div class="p-3 bg-indigo-50 rounded-lg"><svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/></svg></div>
            </div>
            <p class="text-sm text-gray-500 mt-2">{{ $stats['total_clients'] }} clients</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Activation Keys</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total_keys'] }}</p>
                </div>
                <div class="p-3 bg-green-50 rounded-lg"><svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg></div>
            </div>
            <p class="text-sm text-green-600 mt-2">{{ $stats['active_keys'] }} active</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Subscriptions</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['active_subscriptions'] }}</p>
                </div>
                <div class="p-3 bg-purple-50 rounded-lg"><svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            </div>
            <p class="text-sm text-gray-500 mt-2">{{ $stats['total_plans'] }} plans</p>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Users</h2>
            <div class="space-y-3">
                @forelse($stats['recent_users'] as $user)
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center text-sm font-medium">{{ substr($user->name, 0, 2) }}</div>
                            <div><p class="text-sm font-medium text-gray-900">{{ $user->name }}</p><p class="text-xs text-gray-500">{{ $user->email }}</p></div>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $user->role === 'super_admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700' }}">{{ str_replace('_', ' ', $user->role) }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No users yet.</p>
                @endforelse
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Keys</h2>
            <div class="space-y-3">
                @forelse($stats['recent_keys'] as $key)
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                        <div><p class="text-sm font-mono font-medium text-gray-900">{{ $key->key }}</p><p class="text-xs text-gray-500">{{ $key->user->name ?? 'N/A' }}</p></div>
                        <span class="px-2 py-1 text-xs font-medium rounded-full 
                            @if($key->status === 'active') bg-green-100 text-green-700
                            @elseif($key->status === 'expired') bg-red-100 text-red-700
                            @elseif($key->status === 'revoked') bg-gray-100 text-gray-700
                            @else bg-yellow-100 text-yellow-700 @endif">{{ $key->status }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No keys yet.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
