<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">
    <div x-data="{ menuOpen: false }" class="min-h-screen">
        <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center gap-3">
                        <x-logo />
                    </div>
                    <nav class="hidden md:flex items-center gap-6">
                        <a href="#features" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Features</a>
                        <a href="#pricing" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Pricing</a>
                        @foreach($headerPages as $p)
                        <a href="{{ route('page', $p->slug) }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">{{ $p->title }}</a>
                        @endforeach
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Login</a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Get Started</a>
                        @endauth
                    </nav>
                    <button @click="menuOpen = !menuOpen" class="md:hidden p-2 text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': menuOpen, 'inline-flex': !menuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{ 'hidden': !menuOpen, 'inline-flex': menuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div :class="{ 'block': menuOpen, 'hidden': !menuOpen }" class="md:hidden pb-4 border-t border-gray-100 pt-4">
                    <div class="flex flex-col gap-3">
                        <a href="#features" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Features</a>
                        <a href="#pricing" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Pricing</a>
                        @foreach($headerPages as $p)
                        <a href="{{ route('page', $p->slug) }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">{{ $p->title }}</a>
                        @endforeach
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-center text-sm font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Login</a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-center text-sm font-medium">Get Started</a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>
        <section class="bg-gradient-to-br from-indigo-600 via-indigo-700 to-purple-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-28">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight mb-6">Manage Your Software Licenses with Ease</h1>
                    <p class="text-lg sm:text-xl text-indigo-200 mb-8 max-w-2xl mx-auto">Create, manage, and validate activation keys for your web apps, desktop software, and mobile applications. Complete subscription management for your clients.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-3 bg-white text-indigo-700 rounded-lg font-semibold hover:bg-indigo-50 text-center">Go to Dashboard</a>
                        @else
                            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3 bg-white text-indigo-700 rounded-lg font-semibold hover:bg-indigo-50 text-center">Start Free Trial</a>
                            <a href="#pricing" class="w-full sm:w-auto px-8 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white/10 text-center">View Pricing</a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>
        <section id="features" class="py-16 sm:py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-4">Everything You Need</h2>
                <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Powerful tools to manage your software licensing from one place.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    <div class="bg-white rounded-xl p-6 sm:p-8 shadow-sm border border-gray-200">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4"><svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg></div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Key Generation</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Generate unique, secure activation keys for any product type with one click.</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 sm:p-8 shadow-sm border border-gray-200">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4"><svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Subscription Plans</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Create flexible pricing plans with customizable key limits and billing periods.</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 sm:p-8 shadow-sm border border-gray-200">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4"><svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Secure Validation</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Validate and track every key activation with detailed event logging and IP tracking.</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 sm:p-8 shadow-sm border border-gray-200">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4"><svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Client Management</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Manage your clients and their activation keys from a dedicated dashboard.</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 sm:p-8 shadow-sm border border-gray-200">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4"><svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg></div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Analytics</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Track key usage, activations, and subscription status with detailed analytics.</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 sm:p-8 shadow-sm border border-gray-200">
                        <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mb-4"><svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">2FA Security</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Protect your account with two-factor authentication for enhanced security.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="pricing" class="py-16 sm:py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-4">Simple, Transparent Pricing</h2>
                <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Choose the plan that fits your needs. No hidden fees.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 max-w-5xl mx-auto">
                    @forelse($plans as $plan)
                    @php $isPopular = $loop->iteration === 2; @endphp
                    <div class="rounded-xl p-6 sm:p-8 {{ $isPopular ? 'bg-gray-900 text-white ring-2 ring-indigo-500 lg:scale-105' : 'bg-white border border-gray-200 text-gray-900' }} shadow-sm">
                        <h3 class="text-xl font-bold {{ $isPopular ? 'text-white' : 'text-gray-900' }}">{{ $plan->name }}</h3>
                        <p class="{{ $isPopular ? 'text-gray-400' : 'text-gray-500' }} mt-2 text-sm">{{ $plan->description }}</p>
                        <p class="mt-6 flex items-baseline gap-1">
                            <span class="text-4xl font-bold">${{ number_format($plan->price, 0) }}</span>
                            <span class="text-sm {{ $isPopular ? 'text-gray-400' : 'text-gray-500' }}">/{{ $plan->billing_period }}</span>
                        </p>
                        <ul class="mt-8 space-y-3">
                            <li class="flex items-center gap-2 text-sm"><svg class="w-5 h-5 {{ $isPopular ? 'text-indigo-400' : 'text-indigo-600' }} shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> {{ $plan->max_keys > 0 ? $plan->max_keys : 'Unlimited' }} Keys</li>
                            @if($plan->features->count())@foreach($plan->features as $feature)<li class="flex items-center gap-2 text-sm"><svg class="w-5 h-5 {{ $isPopular ? 'text-indigo-400' : 'text-indigo-600' }} shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> {{ $feature->name }}</li>@endforeach @endif
                        </ul>
                        @if($plan->price == 0)
                            <a href="{{ route('register') }}" class="mt-8 block w-full py-3 text-center rounded-lg font-semibold text-sm {{ $isPopular ? 'bg-indigo-600 text-white hover:bg-indigo-700' : 'bg-gray-100 text-gray-900 hover:bg-gray-200' }}">Get Started Free</a>
                        @elseif($plan->stripe_price_id && auth()->check())
                            <form method="POST" action="{{ route('checkout.session', $plan) }}">
                                @csrf
                                <button type="submit" class="mt-8 block w-full py-3 text-center rounded-lg font-semibold text-sm {{ $isPopular ? 'bg-indigo-600 text-white hover:bg-indigo-700' : 'bg-gray-100 text-gray-900 hover:bg-gray-200' }}">Subscribe Now</button>
                            </form>
                        @elseif($plan->stripe_price_id)
                            <a href="{{ route('register') }}" class="mt-8 block w-full py-3 text-center rounded-lg font-semibold text-sm {{ $isPopular ? 'bg-indigo-600 text-white hover:bg-indigo-700' : 'bg-gray-100 text-gray-900 hover:bg-gray-200' }}">Get Started</a>
                        @else
                            <span class="mt-8 block w-full py-3 text-center rounded-lg font-semibold text-sm bg-gray-100 text-gray-400 cursor-not-allowed">Coming Soon</span>
                        @endif
                    </div>
                    @empty
                    <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center text-gray-500 py-12">No plans available yet.</div>
                    @endforelse
                </div>
            </div>
        </section>
        <footer class="bg-gray-900 text-gray-400 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($footerPages->count())
                <div class="flex flex-wrap justify-center gap-6 mb-6">
                    @foreach($footerPages as $p)
                    <a href="{{ route('page', $p->slug) }}" class="text-gray-400 hover:text-white text-sm">{{ $p->title }}</a>
                    @endforeach
                </div>
                @endif
                <div class="text-center space-y-2">
                    <p>Copyright &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                    @if (config('app.footer_text'))
                        <p class="text-sm">{{ config('app.footer_text') }}</p>
                    @endif
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
