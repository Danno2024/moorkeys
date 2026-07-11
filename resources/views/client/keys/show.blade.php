@extends('client.layouts.app')
@section('title', 'Key Details')
@section('content')
<div class="mb-6"><a href="{{ route('client.keys.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Keys</a></div>
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <h2 class="text-lg font-bold text-gray-900 mb-6">Key Details</h2>
        <div class="bg-gray-50 rounded-lg p-4 mb-6 text-center">
            <p class="text-xs text-gray-500 uppercase mb-1">Activation Key</p>
            <p class="text-2xl font-mono font-bold text-gray-900 tracking-wider">{{ $activationKey->key }}</p>
        </div>
        <dl class="grid grid-cols-2 gap-4">
            <div><dt class="text-xs font-medium text-gray-500 uppercase">Status</dt><dd class="mt-1">
                <span class="px-2 py-1 text-xs font-medium rounded-full @if($activationKey->status === 'active') bg-green-100 text-green-700 @else bg-red-100 text-red-700 @endif">{{ $activationKey->status }}</span>
            </dd></div>
            <div><dt class="text-xs font-medium text-gray-500 uppercase">Product Type</dt><dd class="mt-1 text-gray-900 capitalize">{{ $activationKey->product_type }}</dd></div>
            <div><dt class="text-xs font-medium text-gray-500 uppercase">Client Name</dt><dd class="mt-1 text-gray-900">{{ $activationKey->client_name ?? 'N/A' }}</dd></div>
            <div><dt class="text-xs font-medium text-gray-500 uppercase">Client Email</dt><dd class="mt-1 text-gray-900">{{ $activationKey->client_email ?? 'N/A' }}</dd></div>
            <div><dt class="text-xs font-medium text-gray-500 uppercase">Claimed By</dt><dd class="mt-1 text-gray-900">{{ $activationKey->owner?->name ?? $activationKey->owner?->email ?? 'Not claimed' }}</dd></div>
            <div><dt class="text-xs font-medium text-gray-500 uppercase">Domain</dt><dd class="mt-1 text-gray-900">{{ $activationKey->domain ?? 'N/A' }}</dd></div>
            <div><dt class="text-xs font-medium text-gray-500 uppercase">Plan</dt><dd class="mt-1 text-gray-900">{{ $activationKey->plan->name ?? 'N/A' }}</dd></div>
            <div><dt class="text-xs font-medium text-gray-500 uppercase">Activated</dt><dd class="mt-1 text-gray-900">{{ $activationKey->activated_at ? $activationKey->activated_at->format('Y-m-d H:i') : 'N/A' }}</dd></div>
            <div><dt class="text-xs font-medium text-gray-500 uppercase">Expires</dt><dd class="mt-1 text-gray-900">{{ $activationKey->expires_at ? $activationKey->expires_at->format('Y-m-d H:i') : 'Never' }}</dd></div>
        </dl>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('client.keys.edit', $activationKey) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Edit Key</a>
        @if($activationKey->status === 'active')
            <form method="POST" action="{{ route('client.keys.revoke', $activationKey) }}" onsubmit="return confirm('Revoke this key? It will no longer be valid.')">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">Revoke Key</button>
            </form>
        @endif
    </div>
</div>
@endsection
