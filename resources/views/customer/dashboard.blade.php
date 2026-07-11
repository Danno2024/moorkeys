<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>License Portal - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-8">
                    <a href="/" class="text-xl font-bold text-indigo-600">{{ config('app.name') }}</a>
                    <div class="hidden sm:flex items-center gap-1">
                        <a href="{{ route('customer.dashboard') }}"
                           class="px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('customer.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-gray-900' }}">
                            My Licenses
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-500">{{ auth()->user()->email }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 font-medium">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border p-6 mb-8">
            <h2 class="text-lg font-bold text-gray-900">Welcome, {{ auth()->user()->name }}</h2>
            <p class="text-sm text-gray-500 mt-1">Manage your software licenses and activations</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border p-6 mb-8">
            <h3 class="font-semibold text-gray-900 mb-4">Claim a License Key</h3>
            <form method="POST" action="{{ route('customer.claim') }}" class="flex gap-3">
                @csrf
                <input type="text" name="key" placeholder="Enter your license key" required
                       class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">
                    Claim
                </button>
            </form>
            @error('key') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <h3 class="font-semibold text-gray-900 mb-4">My Licenses ({{ $claimedKeys->count() }})</h3>

            @if($claimedKeys->isEmpty())
                <div class="bg-white rounded-2xl shadow-sm border p-12 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500">You haven't claimed any license keys yet.</p>
                    <p class="text-sm text-gray-400 mt-1">Enter your license key above to get started.</p>
                </div>
            @else
                <div class="grid gap-4">
                    @foreach($claimedKeys as $key)
                        <div class="bg-white rounded-2xl shadow-sm border p-5">
                            <div class="flex items-start justify-between">
                                <div class="flex-1 min-w-0">
                                    <code class="text-sm font-mono font-bold text-gray-900 select-all block truncate">{{ $key->key }}</code>
                                    <div class="flex flex-wrap items-center gap-3 mt-2 text-sm text-gray-500">
                                        <span>{{ $key->plan->name ?? 'N/A' }}</span>
                                        <span class="text-gray-300">&middot;</span>
                                        <span>Issued by {{ $key->user->name ?? 'N/A' }}</span>
                                        @if($key->expires_at)
                                            <span class="text-gray-300">&middot;</span>
                                            <span class="{{ $key->expires_at->isPast() ? 'text-red-600' : '' }}">
                                                Expires {{ $key->expires_at->format('M d, Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 ml-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $key->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($key->status) }}
                                    </span>
                                    <form method="POST" action="{{ route('customer.unclaim', $key) }}"
                                          onsubmit="return confirm('Remove this license from your account?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>

                            @if($key->domain)
                                <div class="mt-3 text-sm text-gray-500">
                                    Domain: <span class="font-medium text-gray-700">{{ $key->domain }}</span>
                                </div>
                            @endif

                            @if($key->client_name)
                                <div class="mt-1 text-sm text-gray-500">
                                    Registered to: <span class="font-medium text-gray-700">{{ $key->client_name }}</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

    <footer class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto px-4 py-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </footer>
</body>
</html>
