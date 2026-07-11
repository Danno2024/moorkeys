@extends('admin.layouts.app')
@section('title', 'Edit Key')
@section('content')
<div class="mb-6"><a href="{{ route('admin.keys.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Keys</a></div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">
    <h2 class="text-xl font-bold text-gray-900 mb-6">Edit Key: {{ $activationKey->key }}</h2>
    <form method="POST" action="{{ route('admin.keys.update', $activationKey) }}">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Owner</label><select name="user_id" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>@foreach($users as $user)<option value="{{ $user->id }}" {{ $activationKey->user_id === $user->id ? 'selected' : '' }}>{{ $user->name }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Plan</label><select name="plan_id" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="">No plan</option>@foreach($plans as $plan)<option value="{{ $plan->id }}" {{ $activationKey->plan_id === $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Status</label><select name="status" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="active" {{ $activationKey->status === 'active' ? 'selected' : '' }}>Active</option><option value="expired" {{ $activationKey->status === 'expired' ? 'selected' : '' }}>Expired</option><option value="revoked" {{ $activationKey->status === 'revoked' ? 'selected' : '' }}>Revoked</option><option value="suspended" {{ $activationKey->status === 'suspended' ? 'selected' : '' }}>Suspended</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Product Type</label><select name="product_type" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="web" {{ $activationKey->product_type === 'web' ? 'selected' : '' }}>Web</option><option value="desktop" {{ $activationKey->product_type === 'desktop' ? 'selected' : '' }}>Desktop</option><option value="mobile" {{ $activationKey->product_type === 'mobile' ? 'selected' : '' }}>Mobile</option><option value="api" {{ $activationKey->product_type === 'api' ? 'selected' : '' }}>API</option><option value="other" {{ $activationKey->product_type === 'other' ? 'selected' : '' }}>Other</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Client Name</label><input type="text" name="client_name" value="{{ old('client_name', $activationKey->client_name) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Client Email</label><input type="email" name="client_email" value="{{ old('client_email', $activationKey->client_email) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Domain</label><input type="text" name="domain" value="{{ old('domain', $activationKey->domain) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Expires At</label><input type="date" name="expires_at" value="{{ old('expires_at', $activationKey->expires_at?->format('Y-m-d')) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
        </div>
        <div class="flex items-center justify-end gap-3 mt-6">
            <a href="{{ route('admin.keys.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 text-sm">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Update Key</button>
        </div>
    </form>
</div>
@endsection
