<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - MoorKeys Installer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 flex flex-col">
    <main class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-2xl">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-indigo-600 rounded-2xl mb-6">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Welcome to MoorKeys</h1>
                <p class="text-lg text-gray-600">License Key Management Platform</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Quick Setup</h2>
                    <p class="text-gray-600 mt-1">Get your MoorKeys instance running in minutes</p>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                        <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <span class="text-indigo-600 font-bold text-xl">1</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Requirements Check</h3>
                            <p class="text-gray-600 text-sm">Verify server compatibility</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                        <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <span class="text-indigo-600 font-bold text-xl">2</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Database Setup</h3>
                            <p class="text-gray-600 text-sm">Configure MySQL connection</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                        <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <span class="text-indigo-600 font-bold text-xl">3</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Admin Account</h3>
                            <p class="text-gray-600 text-sm">Create your super admin user</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                        <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <span class="text-indigo-600 font-bold text-xl">4</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Finish</h3>
                            <p class="text-gray-600 text-sm">Choose demo data or start empty</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 mb-8">
                <a href="{{ route('install.requirements') }}" class="block w-full py-4 px-6 bg-indigo-600 text-white rounded-xl font-semibold text-center hover:bg-indigo-700 transition-colors">
                    Start Installation
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden p-6">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    System Requirements
                </h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> PHP 8.1 or higher</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> MySQL 5.7+ / MariaDB 10.3+</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Composer for dependencies</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Extensions: PDO, OpenSSL, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo</li>
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Write permissions on storage/ and bootstrap/cache/</li>
                </ul>
            </div>
        </div>
    </main>
</body>
</html>