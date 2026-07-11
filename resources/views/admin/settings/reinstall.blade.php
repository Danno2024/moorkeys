@extends('admin.layouts.app')
@section('title', 'System Reinstall')
@section('content')
<div class="mb-6"><a href="{{ route('admin.settings.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Settings</a></div>

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 bg-red-50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">System Reinstall</h2>
                    <p class="text-sm text-gray-600 mt-1">Complete system reset - destroys all data</p>
                </div>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <h3 class="font-semibold text-red-800 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293a1 1 0 00-1.414 0z" clip-rule="evenodd"/></svg>
                    <span>WARNING: This action is IRREVERSIBLE</span>
                </h3>
                <ul class="mt-3 space-y-2 text-sm text-red-700">
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293a1 1 0 00-1.414 0z" clip-rule="evenodd"/></svg>All database tables will be DROPPED (users, keys, plans, settings, everything)</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293a1 1 0 00-1.414 0z" clip-rule="evenodd"/></svg>All admin users, clients, activation keys, plans, pages, templates will be PERMANENTLY DELETED</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293a1 1 0 00-1.414 0z" clip-rule="evenodd"/></svg>Email templates, invoice templates, pages, and all settings will be ERASED</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293a1 1 0 00-1.414 0z" clip-rule="evenodd"/></svg>You will be redirected to the installer to set up from scratch</li>
                </ul>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <h3 class="font-semibold text-yellow-800 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    <span>When to use this</span>
                </h3>
                <p class="text-sm text-yellow-700 mt-1">Use this only if you want to completely start over, or if your installation is corrupted and you need a fresh start. Make sure you have backups of any important data first!</p>
            </div>

            <form method="POST" action="{{ route('admin.settings.reinstall.confirm') }}" onsubmit="return confirm('⚠️ THIS WILL PERMANENTLY DELETE ALL DATA!\n\nAre you absolutely sure you want to proceed?\n\nType YES in the checkbox below to confirm.')">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="confirm" value="1" required class="mt-1 h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <div class="text-sm text-gray-700">
                                <span class="font-semibold">I understand this will PERMANENTLY DELETE all data</span>
                                <p class="text-gray-500 mt-1">Including all users, activation keys, plans, settings, templates, pages, and email templates. This cannot be undone.</p>
                            </div>
                        </label>
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <button type="submit" class="w-full py-3 px-6 bg-red-600 text-white rounded-lg font-semibold text-sm hover:bg-red-700 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                            </svg>
                            Reinstall System Now
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection