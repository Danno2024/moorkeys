<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Requirements - MoorKeys Installer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col">
    <main class="flex-1 px-4 py-12">
        <div class="w-full max-w-3xl mx-auto">
            <div class="text-center mb-8">
                <a href="{{ route('install.welcome') }}" class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Server Requirements Check</h1>
                <p class="text-gray-600 mt-1">Verifying your server meets all requirements</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Requirement Status</h2>
                </div>

                <div class="divide-y divide-gray-200">
                    @foreach($requirements as $name => $passed)
                    <div class="p-6 flex items-center justify-between hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            @if($passed)
                                <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                            @else
                                <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L10.586 10l-1.707 1.707a1 1 0 001.414 1.414L10 11.414l1.707 1.707a1 1 0 001.414-1.414L11.414 10l1.707-1.707a1 1 0 00-1.414-1.414L10 8.586 8.293 6.854a1 1 0 00-1.414 0z"/></svg>
                            @endif
                            <span class="font-medium text-gray-900">{{ $name }}</span>
                        </div>
                        @if($passed)
                            <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Pass</span>
                        @else
                            <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Fail</span>
                        @endif
                    </div>
                    @endforeach
                </div>

                <div class="p-6 border-t border-gray-200 bg-gray-50">
                    @php
                        $allPassed = !in_array(false, $requirements, true);
                    @endphp
                    
                    @if($allPassed)
                        <div class="flex items-center gap-3 p-4 bg-green-50 border border-green-200 rounded-lg mb-4">
                            <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                            <span class="font-medium text-green-800">All requirements passed! You're ready to continue.</span>
                        </div>
                        <a href="{{ route('install.database') }}" class="w-full py-3 px-6 bg-indigo-600 text-white rounded-lg font-semibold text-center hover:bg-indigo-700 transition-colors block">
                            Continue to Database Setup
                        </a>
                    @else
                        <div class="flex items-center gap-3 p-4 bg-red-50 border border-red-200 rounded-lg mb-4">
                            <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L10.586 10l-1.707 1.707a1 1 0 001.414 1.414L10 11.414l1.707 1.707a1 1 0 001.414-1.414L11.414 10l1.707-1.707a1 1 0 00-1.414-1.414L10 8.586 8.293 6.854a1 1 0 00-1.414 0z"/></svg>
                            <span class="font-medium text-red-800">Some requirements failed. Please resolve the issues above before continuing.</span>
                        </div>
                        <a href="{{ route('install.requirements') }}" class="w-full py-3 px-6 bg-gray-200 text-gray-600 rounded-lg font-semibold text-center hover:bg-gray-300 transition-colors block">
                            Re-check Requirements
                        </a>
                    @endif
                </div>
            </div>

            <p class="text-center text-sm text-gray-500 mt-6"><a href="{{ route('install.welcome') }}" class="text-indigo-600 hover:underline">&larr; Back to Welcome</a></p>
        </div>
    </main>
</body>
</html>