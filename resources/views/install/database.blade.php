<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup - MoorKeys Installer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col">
    <main class="flex-1 px-4 py-12">
        <div class="w-full max-w-md mx-auto">
            <div class="text-center mb-8">
                <a href="{{ route('install.welcome') }}" class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Database Configuration</h1>
                <p class="text-gray-600 mt-1">Enter your database connection details</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                @if(session('error'))
                    <div class="p-4 bg-red-50 border border-red-200 rounded-t-xl mx-4 mt-4 text-red-700 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('install.database') }}" class="p-6 space-y-5">
                    @csrf

                    <div>
                        <label for="db_host" class="block text-sm font-medium text-gray-700 mb-1">Database Host</label>
                        <input type="text" id="db_host" name="db_host" value="{{ old('db_host', '127.0.0.1') }}" required
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                    </div>

                    <div>
                        <label for="db_port" class="block text-sm font-medium text-gray-700 mb-1">Database Port</label>
                        <input type="number" id="db_port" name="db_port" value="{{ old('db_port', '3306') }}" required
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                    </div>

                    <div>
                        <label for="db_database" class="block text-sm font-medium text-gray-700 mb-1">Database Name</label>
                        <input type="text" id="db_database" name="db_database" value="{{ old('db_database', 'moorkeys') }}" required
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                    </div>

                    <div>
                        <label for="db_username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" id="db_username" name="db_username" value="{{ old('db_username', 'root') }}" required
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                    </div>

                    <div>
                        <label for="db_password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="db_password" name="db_password" value="{{ old('db_password') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                        <p class="text-xs text-gray-500 mt-1">Leave empty if no password</p>
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <button type="submit" class="w-full py-3 px-6 bg-indigo-600 text-white rounded-lg font-semibold text-sm hover:bg-indigo-700 transition-colors">
                            Test Connection & Continue
                        </button>
                    </div>
                </form>

                <div class="p-6 border-t border-gray-200 bg-gray-50">
                    <a href="{{ route('install.requirements') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        &larr; Back to Requirements
                    </a>
                </div>
            </div>

            <p class="text-center text-sm text-gray-500 mt-6"><a href="{{ route('install.welcome') }}" class="text-indigo-600 hover:underline">&larr; Back to Welcome</a></p>
        </div>
    </main>
</body>
</html>