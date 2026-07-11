<x-guest-layout>
    <div class="min-h-screen bg-white">
        <header class="border-b border-gray-200">
            <div class="max-w-4xl mx-auto px-4 py-6 flex items-center justify-between">
                <a href="/"><x-logo /></a>
                <nav class="flex items-center gap-4">
                    <a href="/" class="text-gray-600 hover:text-gray-900">Home</a>
                    @foreach($headerPages as $p)
                    <a href="{{ route('page', $p->slug) }}" class="text-gray-600 hover:text-gray-900">{{ $p->title }}</a>
                    @endforeach
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Login</a>
                    @endauth
                </nav>
            </div>
        </header>
        <main class="max-w-4xl mx-auto px-4 py-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-8">{{ $page->title }}</h1>
            <div class="prose prose-lg max-w-none">{!! nl2br(e($page->content)) !!}</div>
        </main>
        <footer class="border-t border-gray-200 py-8 text-center text-gray-500 text-sm">
            @if($footerPages->count())
            <div class="flex flex-wrap justify-center gap-4 mb-4">
                @foreach($footerPages as $p)
                <a href="{{ route('page', $p->slug) }}" class="text-gray-500 hover:text-gray-700 text-sm">{{ $p->title }}</a>
                @endforeach
            </div>
            @endif
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}</p>
            @if (config('app.footer_text'))
                <p class="mt-1">{{ config('app.footer_text') }}</p>
            @endif
        </footer>
    </div>
</x-guest-layout>
