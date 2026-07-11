<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>License Lookup - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen flex flex-col">
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-4xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="/" class="text-xl font-bold text-indigo-600">{{ config('app.name') }}</a>
            <a href="{{ route('customer.register') }}" class="text-sm text-indigo-600 hover:underline">License Portal</a>
        </div>
    </header>

    <main class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-2xl">
            @if($activationKey)
                <div class="bg-white rounded-2xl shadow-lg border overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-white">License Key Details</h1>
                        <p class="text-indigo-100 mt-1 text-sm">Verify the status and details of your license</p>
                    </div>

                    <div class="p-6 space-y-5">
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <code class="text-lg font-mono font-bold text-gray-900 select-all">{{ $activationKey->key }}</code>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Status</p>
                                @php
                                    $statusClass = match($activationKey->status) {
                                        'active' => 'bg-green-100 text-green-800',
                                        'expired' => 'bg-red-100 text-red-800',
                                        'revoked' => 'bg-gray-100 text-gray-800',
                                        'suspended' => 'bg-yellow-100 text-yellow-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <p class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                        {{ ucfirst($activationKey->status) }}
                                    </span>
                                </p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Product</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $activationKey->plan->name ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Issued To</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $activationKey->client_name ?: 'N/A' }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Expires</p>
                                <p class="mt-1 font-semibold text-gray-900 {{ $activationKey->expires_at && $activationKey->expires_at->isPast() ? 'text-red-600' : '' }}">
                                    {{ $activationKey->expires_at ? $activationKey->expires_at->format('M d, Y') : 'Never' }}
                                </p>
                            </div>
                        </div>

                        @if($activationKey->domain)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Registered Domain</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $activationKey->domain }}</p>
                            </div>
                        @endif

                        @if($activationKey->metadata && count($activationKey->metadata) > 0)
                            <div class="border-t pt-4">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Additional Details</p>
                                <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                                    @foreach($activationKey->metadata as $metaKey => $metaValue)
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600 capitalize">{{ str_replace('_', ' ', $metaKey) }}</span>
                                            <span class="text-sm font-medium text-gray-900">{{ is_array($metaValue) ? json_encode($metaValue) : $metaValue }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="text-center text-xs text-gray-400 pt-2">
                            <p>Verified on {{ now()->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-lg border overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">License Key Not Found</h2>
                        <p class="text-gray-500 mt-2">The license key you entered could not be found. Please check and try again.</p>
                        <a href="/" class="mt-6 inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">Go Home</a>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <footer class="bg-white border-t mt-auto">
        <div class="max-w-4xl mx-auto px-4 py-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </footer>
</body>
</html>
