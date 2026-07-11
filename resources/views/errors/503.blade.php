<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Maintenance</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #111827; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .container { text-align: center; padding: 2rem; max-width: 480px; }
        .icon { width: 64px; height: 64px; background: #eef2ff; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; }
        .icon svg { width: 32px; height: 32px; color: #6366f1; }
        h1 { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; }
        .message { color: #6b7280; line-height: 1.6; margin-bottom: 2rem; }
        .brand { color: #9ca3af; font-size: 0.875rem; }
        .brand strong { color: #6366f1; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h1>Down for Maintenance</h1>
        <p class="message">
            @php $data = app()->maintenanceMode()->data(); @endphp
            {{ $data['retry'] ?? 'We are currently performing scheduled maintenance. We\'ll be back shortly.' }}
        </p>
        <p class="brand">&copy; {{ date('Y') }} <strong>{{ config('app.name') }}</strong></p>
    </div>
</body>
</html>
