<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Already Installed - MoorKeys</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col">
    <main class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-2xl">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-indigo-100 rounded-2xl mb-6">
                    <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">MoorKeys is Already Installed</h1>
                <p class="text-gray-600">The installer has already been completed.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 text-center">
                <div class="mb-6">
                    <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900 mb-3">Installation Complete</h2>
                <p class="text-gray-600 mb-6">MoorKeys is already set up and ready to use. You cannot run the installer again unless you perform a full reinstall.</p>

                <div class="space-y-3">
                    <a href="/" class="inline-block w-full py-3 px-6 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                        Go to Homepage
                    </a>
                    <a href="/login" class="inline-block w-full py-3 px-6 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-colors">
                        Login to Admin
                    </a>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <p class="text-sm text-gray-500 mb-3">Need to start fresh?</p>
                    <p class="text-sm text-gray-500">Administrators can trigger a full reinstall from the admin panel:</p>
                    <a href="/admin/settings/reinstall" class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Admin Reinstall (Admin only)
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>