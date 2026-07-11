@extends('admin.layouts.app')
@section('title', 'Create Plan')
@section('content')
<div class="mb-6"><a href="{{ route('admin.plans.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Plans</a></div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">
    <h2 class="text-xl font-bold text-gray-900 mb-6">Create Plan</h2>
    <form method="POST" action="{{ route('admin.plans.store') }}" x-data="{ features: [] }">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Plan Name</label><input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Description</label><textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label><input type="number" step="0.01" min="0" name="price" value="{{ old('price', '0') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Billing Period</label><select name="billing_period" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="monthly">Monthly</option><option value="yearly" selected>Yearly</option><option value="lifetime">Lifetime</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Max Keys (0 = unlimited)</label><input type="number" min="0" name="max_keys" value="{{ old('max_keys', '0') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label><input type="number" min="0" name="sort_order" value="{{ old('sort_order', '0') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Stripe Price ID</label><input type="text" name="stripe_price_id" value="{{ old('stripe_price_id') }}" placeholder="price_xxxxxxxxxxxxx" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Active</label><select name="is_active" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="1">Yes</option><option value="0">No</option></select></div>
        </div>

        <div class="border-t border-gray-200 pt-6 mt-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Plan Features</h3>
                <button type="button" @click="features.push({ name: '', description: '', icon: '', sort_order: features.length })" class="px-3 py-1.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Add Feature</button>
            </div>
            <template x-for="(feature, index) in features" :key="index">
                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg mb-3">
                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                        <input type="hidden" :name="'features[' + index + '][sort_order]'" x-model="feature.sort_order">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Feature Name</label>
                            <input type="text" :name="'features[' + index + '][name]'" x-model="feature.name" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Description (optional)</label>
                            <input type="text" :name="'features[' + index + '][description]'" x-model="feature.description" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Icon (optional, e.g. key, shield)</label>
                            <input type="text" :name="'features[' + index + '][icon]'" x-model="feature.icon" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>
                    </div>
                    <button type="button" @click="features.splice(index, 1)" class="mt-6 p-1.5 text-red-500 hover:text-red-700 hover:bg-red-50 rounded">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            </template>
            <p x-show="features.length === 0" class="text-sm text-gray-500 italic py-4 text-center">No features added yet. Click "Add Feature" to add plan features.</p>
        </div>

        <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.plans.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 text-sm">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Create Plan</button>
        </div>
    </form>
</div>
@endsection
