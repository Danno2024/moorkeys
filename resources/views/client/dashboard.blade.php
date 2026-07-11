@extends('client.layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Welcome, {{ auth()->user()->name }}</h1>
    <p class="text-gray-600 mt-1">Manage your activation keys and account.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div><p class="text-sm font-medium text-gray-500">Total Keys</p><p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total_keys'] }}</p></div>
            <div class="p-3 bg-indigo-50 rounded-lg"><svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg></div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div><p class="text-sm font-medium text-gray-500">Active Keys</p><p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['active_keys'] }}</p></div>
            <div class="p-3 bg-green-50 rounded-lg"><svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Subscription</p>
                @if($stats['subscription'])
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ $stats['subscription']->plan->name ?? 'Active' }}</p>
                    @if($stats['subscription']->ends_at)
                        <p class="text-xs text-gray-500 mt-1">Renews: {{ $stats['subscription']->ends_at->format('M d, Y') }}</p>
                    @endif
                @else
                    <p class="text-lg font-bold text-gray-900 mt-1">No Plan</p>
                    <p class="text-xs text-gray-500 mt-1"><a href="{{ route('home') }}#pricing" class="text-indigo-600 hover:underline">View plans</a></p>
                @endif
            </div>
            <div class="flex flex-col items-end gap-2">
                <div class="p-3 bg-purple-50 rounded-lg"><svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                @if($stats['subscription'] && $stats['subscription']->stripe_subscription_id)
                    <a href="{{ route('billing.portal') }}" class="text-xs text-indigo-600 hover:underline">Manage Billing</a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold text-gray-900">Recent Keys</h2>
        <a href="{{ route('client.keys.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Create Key</a>
    </div>
    <div class="space-y-3">
        @forelse($recentKeys as $key)
            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                <div>
                    <p class="font-mono text-sm font-medium text-gray-900">{{ $key->key }}</p>
                    <p class="text-xs text-gray-500">{{ $key->client_name ?? 'No client' }} &middot; {{ $key->product_type }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-2 py-1 text-xs font-medium rounded-full @if($key->status === 'active') bg-green-100 text-green-700 @else bg-red-100 text-red-700 @endif">{{ $key->status }}</span>
                    <a href="{{ route('client.keys.show', $key) }}" class="text-indigo-600 hover:text-indigo-800 text-sm">View</a>
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-500 text-center py-6">No keys yet. <a href="{{ route('client.keys.create') }}" class="text-indigo-600 hover:underline">Create your first key</a></p>
        @endforelse
    </div>
</div>
@endsection
