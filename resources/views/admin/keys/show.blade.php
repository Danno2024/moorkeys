@extends('admin.layouts.app')
@section('title', 'Key Details')
@section('content')
<div class="mb-6"><a href="{{ route('admin.keys.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Keys</a></div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Key Details</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Key</dt><dd class="mt-1 font-mono text-lg font-bold text-gray-900">{{ $activationKey->key }}</dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Status</dt><dd class="mt-1"><span class="px-2 py-1 text-xs font-medium rounded-full @if($activationKey->status === 'active') bg-green-100 text-green-700 @elseif($activationKey->status === 'expired') bg-red-100 text-red-700 @else bg-gray-100 text-gray-700 @endif">{{ $activationKey->status }}</span></dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Owner</dt><dd class="mt-1 text-gray-900">{{ $activationKey->user->name ?? 'N/A' }}</dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Plan</dt><dd class="mt-1 text-gray-900">{{ $activationKey->plan->name ?? 'N/A' }}</dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Product Type</dt><dd class="mt-1 text-gray-900 capitalize">{{ $activationKey->product_type }}</dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Domain</dt><dd class="mt-1 text-gray-900">{{ $activationKey->domain ?? 'N/A' }}</dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Client Name</dt><dd class="mt-1 text-gray-900">{{ $activationKey->client_name ?? 'N/A' }}</dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Client Email</dt><dd class="mt-1 text-gray-900">{{ $activationKey->client_email ?? 'N/A' }}</dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Claimed By</dt><dd class="mt-1 text-gray-900">{{ $activationKey->owner?->name ?? $activationKey->owner?->email ?? 'Not claimed' }}</dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Activated</dt><dd class="mt-1 text-gray-900">{{ $activationKey->activated_at ? $activationKey->activated_at->format('Y-m-d H:i') : 'N/A' }}</dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Expires</dt><dd class="mt-1 text-gray-900">{{ $activationKey->expires_at ? $activationKey->expires_at->format('Y-m-d H:i') : 'Never' }}</dd></div>
            </dl>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Event Log</h2>
            <div class="space-y-3">
                @forelse($activationKey->events as $event)
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                        <div><p class="text-sm font-medium text-gray-900 capitalize">{{ str_replace('_', ' ', $event->event_type) }}</p><p class="text-xs text-gray-500">{{ $event->ip_address ?? 'N/A' }}</p></div>
                        <span class="text-xs text-gray-500">{{ $event->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No events logged.</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-sm font-medium text-gray-700 mb-3">Quick Actions</h3>
            <div class="space-y-2">
                <a href="{{ route('admin.keys.edit', $activationKey) }}" class="block w-full text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Edit Key</a>
                <form method="POST" action="{{ route('admin.keys.destroy', $activationKey) }}" onsubmit="return confirm('Delete this key?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="block w-full text-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">Delete Key</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
