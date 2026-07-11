<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Options - MoorKeys Installer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col">
    <main class="flex-1 px-4 py-12">
        <div class="w-full max-w-2xl mx-auto">
            <div class="text-center mb-10">
                <a href="{{ route('install.welcome') }}" class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Setup Options</h1>
                <p class="text-gray-600 mt-1">Choose how you'd like to initialize your MoorKeys installation</p>
            </div>

            <form method="POST" action="{{ route('install.seed') }}" id="seed-form" class="space-y-4">
                @csrf

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <input type="radio" id="empty" name="with_demo" value="0" checked class="sr-only peer">
                    <label for="empty" class="block p-6 cursor-pointer hover:bg-gray-50 transition-colors">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center peer-checked:bg-indigo-100 transition-colors">
                                <svg class="w-6 h-6 text-gray-500 peer-checked:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">Start Empty</h3>
                                <p class="text-gray-600 mt-1">Create a clean installation with only the admin user. No demo data, no sample templates.</p>
                            </div>
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-indigo-600 peer-checked:block hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            </div>
                        </div>
                    </label>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <input type="radio" id="demo" name="with_demo" value="1" class="sr-only peer">
                    <label for="demo" class="block p-6 cursor-pointer hover:bg-gray-50 transition-colors">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center peer-checked:bg-indigo-600 transition-colors">
                                <svg class="w-6 h-6 text-indigo-600 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">Install Demo Data</h3>
                                <p class="text-gray-600 mt-1">Populate with sample plans, email templates, invoice templates, pages, and settings. Great for testing and evaluation.</p>
                            </div>
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-gray-300 peer-checked:text-indigo-600 peer-checked:block hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            </div>
                        </div>
                    </label>
                </div>

                <button type="submit" class="w-full py-3 px-6 bg-indigo-600 text-white rounded-lg font-semibold text-sm hover:bg-indigo-700 transition-colors mt-4">
                    Complete Installation
                </button>
            </form>

            <div class="mt-6 p-4 bg-gray-50 rounded-xl">
                <a href="{{ route('install.admin') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                    &larr; Back to Admin Setup
                </a>
            </div>
        </div>
    </main>
</body>
</html>