@extends('client.layouts.app')
@section('title', 'Create Key')
@section('content')
<div class="mb-6"><a href="{{ route('client.keys.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Keys</a></div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">
    <h2 class="text-xl font-bold text-gray-900 mb-6">Create Activation Key</h2>
    <form method="POST" action="{{ route('client.keys.store') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Plan (optional)</label><select name="plan_id" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="">No plan</option>@foreach($plans as $plan)<option value="{{ $plan->id }}">{{ $plan->name }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Product Type</label><select name="product_type" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="web">Web Application</option><option value="desktop">Desktop Software</option><option value="mobile">Mobile App</option><option value="api">API</option><option value="other">Other</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Client Name</label><input type="text" name="client_name" value="{{ old('client_name') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Client Email</label><input type="email" name="client_email" value="{{ old('client_email') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Domain</label><input type="text" name="domain" value="{{ old('domain') }}" placeholder="example.com" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Expires At (optional)</label><input type="date" name="expires_at" value="{{ old('expires_at') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
        </div>
        <div class="flex items-center justify-end gap-3 mt-6">
            <a href="{{ route('client.keys.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 text-sm">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Generate Key</button>
        </div>
    </form>
</div>
@endsection
