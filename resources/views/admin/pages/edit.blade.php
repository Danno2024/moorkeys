@extends('admin.layouts.app')
@section('title', 'Edit Page')
@section('content')
<div class="mb-6"><a href="{{ route('admin.pages.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Pages</a></div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h2 class="text-xl font-bold text-gray-900 mb-6">Edit Page: {{ $page->title }}</h2>
    <form method="POST" action="{{ route('admin.pages.update', $page) }}">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Title</label><input type="text" name="title" value="{{ old('title', $page->title) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Slug</label><input type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></div>
            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Content</label><textarea name="content" rows="15" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm">{{ old('content', $page->content) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label><input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label><input type="text" name="meta_description" value="{{ old('meta_description', $page->meta_description) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label><input type="text" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Placement</label><select name="placement" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="none" {{ $page->placement === 'none' ? 'selected' : '' }}>None</option><option value="header" {{ $page->placement === 'header' ? 'selected' : '' }}>Main Menu</option><option value="footer" {{ $page->placement === 'footer' ? 'selected' : '' }}>Footer</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', $page->sort_order) }}" min="0" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Published</label><select name="is_published" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="1" {{ $page->is_published ? 'selected' : '' }}>Yes</option><option value="0" {{ !$page->is_published ? 'selected' : '' }}>No</option></select></div>
        </div>
        <div class="flex items-center justify-end gap-3 mt-6">
            <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 text-sm">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Update Page</button>
        </div>
    </form>
</div>
@endsection
