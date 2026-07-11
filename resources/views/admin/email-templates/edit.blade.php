@extends('admin.layouts.app')
@section('title', 'Edit Email Template')
@section('content')
<div class="mb-6"><a href="{{ route('admin.email-templates.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Templates</a></div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-bold text-gray-900">Edit: {{ $emailTemplate->name }}</h2>
        <p class="text-gray-600 mt-1">Key: <code class="bg-gray-100 px-1.5 py-0.5 rounded text-sm">{{ $emailTemplate->key }}</code></p>
    </div>
    <div class="p-6">
        <form method="POST" action="{{ route('admin.email-templates.update', $emailTemplate) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <div class="lg:col-span-3 space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Key <span class="text-red-500">*</span></label>
                        <input type="text" name="key" value="{{ old('key', $emailTemplate->key) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        <p class="mt-1 text-xs text-gray-500">Unique identifier (snake_case). Used to reference this template in code.</p>
                        @error('key') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $emailTemplate->name) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject <span class="text-red-500">*</span></label>
                        <input type="text" name="subject" value="{{ old('subject', $emailTemplate->subject) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        <p class="mt-1 text-xs text-gray-500">Supports variables like <code class="bg-gray-100 px-1.5 py-0.5 rounded text-sm">@{{name}}</code>, <code class="bg-gray-100 px-1.5 py-0.5 rounded text-sm">@{{app_name}}</code></p>
                        @error('subject') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Variables</label>
                        <input type="text" name="variables" value="{{ old('variables', $emailTemplate->variables ? implode(', ', $emailTemplate->variables) : '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="name, email, app_name, login_url">
                        <p class="mt-1 text-xs text-gray-500">Comma-separated list of variable names (without @{{ }}). Used for documentation and validation.</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $emailTemplate->is_active) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Body (HTML) <span class="text-red-500">*</span></label>
                        <textarea name="body" rows="20" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm" required>{{ old('body', $emailTemplate->body) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Use <code class="bg-gray-100 px-1.5 py-0.5 rounded text-sm">@{{variable}}</code> syntax. See available variables in the sidebar &rarr;</p>
                        @error('body') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-24 bg-gray-50 rounded-xl p-4 border border-gray-200 max-h-[calc(100vh-12rem)] overflow-auto">
                        <h3 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Available Variables
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">Use these variables in your subject and body:</p>
                        
                        <div class="space-y-3 text-sm">
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{name}}</code>
                                <p class="text-gray-600 mt-1">Recipient's full name</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{email}}</code>
                                <p class="text-gray-600 mt-1">Recipient's email address</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{app_name}}</code>
                                <p class="text-gray-600 mt-1">Application name from settings</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{login_url}}</code>
                                <p class="text-gray-600 mt-1">URL to login page</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{dashboard_url}}</code>
                                <p class="text-gray-600 mt-1">URL to user dashboard</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{product_name}}</code>
                                <p class="text-gray-600 mt-1">Product/plan name</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{license_key}}</code>
                                <p class="text-gray-600 mt-1">The activation key</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{activated_at}}</code>
                                <p class="text-gray-600 mt-1">Activation date</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{expires_at}}</code>
                                <p class="text-gray-600 mt-1">Expiration date</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{activations_used}}</code>
                                <p class="text-gray-600 mt-1">Activations used count</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{max_activations}}</code>
                                <p class="text-gray-600 mt-1">Maximum allowed activations</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{renewal_url}}</code>
                                <p class="text-gray-600 mt-1">URL to renew license</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{days_left}}</code>
                                <p class="text-gray-600 mt-1">Days until expiration</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{invoice_number}}</code>
                                <p class="text-gray-600 mt-1">Invoice number</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{amount}}</code>
                                <p class="text-gray-600 mt-1">Invoice amount</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{plan_name}}</code>
                                <p class="text-gray-600 mt-1">Subscription plan name</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <code class="text-indigo-600 font-mono">@{{access_until}}</code>
                                <p class="text-gray-600 mt-1">Access end date</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <p class="text-xs text-gray-500">Tip: You can also create custom variables by adding them to the Variables field above.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-200 lg:col-span-4">
                <a href="{{ route('admin.email-templates.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 text-sm">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Update Template</button>
            </div>
        </form>
    </div>
</div>
@endsection