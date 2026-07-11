@extends('admin.layouts.app')
@section('title', 'Email Templates')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div><h1 class="text-2xl font-bold text-gray-900">Email Templates</h1><p class="text-gray-600 mt-1">Manage transactional email templates.</p></div>
    <a href="{{ route('admin.email-templates.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Add Template</a>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead><tr class="bg-gray-50 border-b border-gray-200">
                <th class="text-left px-6 py-3 font-medium text-gray-600">Name</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Key</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Subject</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Status</th>
                <th class="text-right px-6 py-3 font-medium text-gray-600">Actions</th>
            </tr></thead>
            <tbody>
                @forelse($templates as $template)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $template->name }}</td>
                    <td class="px-6 py-4 text-gray-600"><code class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $template->key }}</code></td>
                    <td class="px-6 py-4 text-gray-600">{{ $template->subject }}</td>
                    <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $template->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ $template->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td class="px-6 py-4 text-right"><div class="flex items-center justify-end gap-3"><a href="{{ route('admin.email-templates.preview', $template) }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium" target="_blank">Preview</a><a href="{{ route('admin.email-templates.edit', $template) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a></div></td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">No email templates yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
