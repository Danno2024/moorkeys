@extends('admin.layouts.app')
@section('title', 'Plans')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div><h1 class="text-2xl font-bold text-gray-900">Pricing Plans</h1><p class="text-gray-600 mt-1">Manage subscription plans.</p></div>
    <a href="{{ route('admin.plans.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Add Plan</a>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead><tr class="bg-gray-50 border-b border-gray-200">
                <th class="text-left px-6 py-3 font-medium text-gray-600">Name</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Price</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Period</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Max Keys</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Features</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Status</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Order</th>
                <th class="text-right px-6 py-3 font-medium text-gray-600">Actions</th>
            </tr></thead>
            <tbody>
                @foreach($plans as $plan)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $plan->name }}</td>
                    <td class="px-6 py-4 text-gray-600">${{ number_format($plan->price, 2) }}</td>
                    <td class="px-6 py-4 text-gray-600 capitalize">{{ $plan->billing_period }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $plan->max_keys > 0 ? $plan->max_keys : 'Unlimited' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $plan->features_count }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ $plan->is_active ? 'Active' : 'Inactive' }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $plan->sort_order }}</td>
                    <td class="px-6 py-4 text-right"><a href="{{ route('admin.plans.edit', $plan) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
