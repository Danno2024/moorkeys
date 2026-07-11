@extends('admin.layouts.app')
@section('title', 'Create Email Template')
@section('content')
<div class="mb-6"><a href="{{ route('admin.email-templates.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Templates</a></div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-3xl">
    <h2 class="text-xl font-bold text-gray-900 mb-6">Create Email Template</h2>
    <form method="POST" action="{{ route('admin.email-templates.store') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Key</label><input type="text" name="key" value="{{ old('key') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g. welcome_email" required></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Name</label><input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Welcome Email" required></div>
            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Subject</label><input type="text" name="subject" value="{{ old('subject') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Variables (comma separated)</label><input type="text" name="variables" value="{{ old('variables') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="@{{name}}, @{{email}}"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Active</label><select name="is_active" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="1" selected>Yes</option><option value="0">No</option></select></div>
            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Email Body (HTML)</label><textarea name="body" rows="15" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm">{{ old('body') }}</textarea></div>
        </div>
        <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.email-templates.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 text-sm">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Create Template</button>
        </div>
    </form>
</div>
@endsection
