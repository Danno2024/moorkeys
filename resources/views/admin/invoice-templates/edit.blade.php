@extends('admin.layouts.app')
@section('title', 'Edit Invoice Template')
@section('content')
<div class="mb-6"><a href="{{ route('admin.invoice-templates.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Templates</a></div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-3xl">
    <h2 class="text-xl font-bold text-gray-900 mb-6">Edit: {{ $invoiceTemplate->name }}</h2>
    <form method="POST" action="{{ route('admin.invoice-templates.update', $invoiceTemplate) }}">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Name</label><input type="text" name="name" value="{{ old('name', $invoiceTemplate->name) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Subject</label><input type="text" name="subject" value="{{ old('subject', $invoiceTemplate->subject) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Invoice Body (HTML)</label><textarea name="body" rows="15" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm">{{ old('body', $invoiceTemplate->body) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Logo Position</label><select name="logo_position" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="left" {{ $invoiceTemplate->logo_position === 'left' ? 'selected' : '' }}>Left</option><option value="center" {{ $invoiceTemplate->logo_position === 'center' ? 'selected' : '' }}>Center</option><option value="right" {{ $invoiceTemplate->logo_position === 'right' ? 'selected' : '' }}>Right</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Set as Default</label><select name="is_default" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="0" {{ !$invoiceTemplate->is_default ? 'selected' : '' }}>No</option><option value="1" {{ $invoiceTemplate->is_default ? 'selected' : '' }}>Yes</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Footer Text</label><textarea name="footer_text" rows="3" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('footer_text', $invoiceTemplate->footer_text) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Terms & Conditions</label><textarea name="terms" rows="3" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('terms', $invoiceTemplate->terms) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Active</label><select name="is_active" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="1" {{ $invoiceTemplate->is_active ? 'selected' : '' }}>Yes</option><option value="0" {{ !$invoiceTemplate->is_active ? 'selected' : '' }}>No</option></select></div>
        </div>
        <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.invoice-templates.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 text-sm">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Update Template</button>
        </div>
    </form>
</div>
@endsection
