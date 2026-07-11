@extends('admin.layouts.app')
@section('title', 'Maintenance Mode')
@section('content')
<div class="mb-6"><a href="{{ route('admin.settings.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Settings</a></div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">
    <h2 class="text-xl font-bold text-gray-900 mb-2">Maintenance Mode</h2>
    <p class="text-gray-600 mb-6">Enable or disable maintenance mode for the public website.</p>
    @php $isDown = app()->isDownForMaintenance(); @endphp
    <div class="mb-6 p-4 rounded-lg {{ $isDown ? 'bg-yellow-50 border border-yellow-200' : 'bg-green-50 border border-green-200' }}">
        <div class="flex items-center gap-3">
            <div class="w-3 h-3 rounded-full {{ $isDown ? 'bg-yellow-500' : 'bg-green-500' }}"></div>
            <span class="font-medium {{ $isDown ? 'text-yellow-700' : 'text-green-700' }}">Currently {{ $isDown ? 'in Maintenance Mode' : 'Live' }}</span>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.settings.toggle-maintenance') }}">
        @csrf
        <input type="hidden" name="mode" value="{{ $isDown ? '0' : '1' }}">
        <div class="space-y-4">
            @if(!$isDown)
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Secret Bypass URL</label><input type="text" name="secret" placeholder="Optional: my-secret" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><p class="text-xs text-gray-500 mt-1">Access site via /my-secret to bypass maintenance.</p></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Custom Message (Retry-After)</label><input type="text" name="message" placeholder="Down for scheduled maintenance." class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            @endif
            <button type="submit" class="px-4 py-2 {{ $isDown ? 'bg-green-600 hover:bg-green-700' : 'bg-yellow-600 hover:bg-yellow-700' }} text-white rounded-lg text-sm">
                {{ $isDown ? 'Disable Maintenance Mode' : 'Enable Maintenance Mode' }}
            </button>
        </div>
    </form>
</div>
@endsection
