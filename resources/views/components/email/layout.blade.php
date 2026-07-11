<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $emailTemplate->name ?? 'Email' }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif; line-height: 1.6; color: #333; background: #f3f4f6; padding: 20px 0; }
        .email-wrapper { max-width: 600px; margin: 0 auto; background: #fff; }
        .email-header { background: #fff; border-bottom: 1px solid #e5e7eb; padding: 20px 24px; }
        .email-header .logo { font-size: 20px; font-weight: 700; color: #4f46e5; text-decoration: none; }
        .email-body { padding: 32px 24px; }
        .email-footer { background: #f9fafb; border-top: 1px solid #e5e7eb; padding: 20px 24px; text-align: center; font-size: 12px; color: #6b7280; }
        .btn { display: inline-block; padding: 12px 24px; background: #4f46e5; color: #fff; text-decoration: none; border-radius: 6px; font-weight: 600; }
        .btn:hover { background: #4338ca; }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <header class="email-header">
            <a href="/" class="logo">{{ config('app.name', 'MoorKeys') }}</a>
            @isset($header)
                <div style="margin-top: 12px;">{{ $header }}</div>
            @endisset
        </header>

        <main class="email-body">
            {{ $slot }}
        </main>

        <footer class="email-footer">
            @isset($footer)
                {{ $footer }}
            @else
                <p style="margin: 0 0 8px;">&copy; {{ date('Y') }} {{ config('app.name', 'MoorKeys') }}. All rights reserved.</p>
                <p style="margin: 0;">This email was sent to {{ $email ?? 'you' }}.</p>
            @endisset
        </footer>
    </div>
</body>
</html>