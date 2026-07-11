@extends('admin.layouts.app')
@section('title', 'Activation Keys')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div><h1 class="text-2xl font-bold text-gray-900">Activation Keys</h1><p class="text-gray-600 mt-1">Manage all activation keys.</p></div>
    <a href="{{ route('admin.keys.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Create Key</a>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
    <form method="GET" class="flex flex-wrap gap-3">
        <input type="text" name="search" placeholder="Search keys, clients..." value="{{ request('search') }}" class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm flex-1 min-w-[200px]">
        <select name="status" class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
            <option value="">All Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired</option>
            <option value="revoked" {{ request('status') === 'revoked' ? 'selected' : '' }}>Revoked</option>
            <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
        </select>
        <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm">Filter</button>
    </form>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead><tr class="bg-gray-50 border-b border-gray-200">
                <th class="text-left px-6 py-3 font-medium text-gray-600">Key</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Owner</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Client</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">End User</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Type</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Status</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Expires</th>
                <th class="text-right px-6 py-3 font-medium text-gray-600">Actions</th>
            </tr></thead>
            <tbody>
                @foreach($keys as $key)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-6 py-4 font-mono text-sm font-medium text-gray-900">{{ $key->key }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $key->user->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $key->client_name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $key->owner?->name ?? $key->owner?->email ?? '—' }}</td>
                    <td class="px-6 py-4"><span class="text-xs uppercase text-gray-500">{{ $key->product_type }}</span></td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-full 
                            @if($key->status === 'active') bg-green-100 text-green-700
                            @elseif($key->status === 'expired') bg-red-100 text-red-700
                            @elseif($key->status === 'revoked') bg-gray-100 text-gray-700
                            @else bg-yellow-100 text-yellow-700 @endif">{{ $key->status }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $key->expires_at ? $key->expires_at->format('Y-m-d') : 'Never' }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.keys.show', $key) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium mr-3">View</a>
                        <a href="{{ route('admin.keys.edit', $key) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">{{ $keys->links() }}</div>
</div>
@endsection
