<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview: {{ $emailTemplate->name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f3f4f6; }
        .toolbar { background: #fff; border-bottom: 1px solid #e5e7eb; padding: 12px 24px; display: flex; align-items: center; gap: 12px; position: sticky; top: 0; z-index: 10; }
        .toolbar h2 { font-size: 14px; font-weight: 600; color: #374151; }
        .toolbar .subject { font-size: 13px; color: #6b7280; }
        .toolbar a { margin-left: auto; font-size: 13px; color: #4f46e5; text-decoration: none; }
        .toolbar a:hover { text-decoration: underline; }
        .email-container { max-width: 600px; margin: 24px auto; background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; }
        .email-body { padding: 32px; }
    </style>
</head>
<body>
    <div class="toolbar">
        <h2>{{ $emailTemplate->name }}</h2>
        <span class="subject">Subject: {{ $emailTemplate->subject }}</span>
        <a href="{{ route('admin.email-templates.edit', $emailTemplate) }}">Edit Template</a>
        <a href="{{ route('admin.email-templates.index') }}">&larr; Back</a>
    </div>
    <div class="email-container">
        <div class="email-body">
            {!! $emailTemplate->body !!}
        </div>
    </div>
</body>
</html>
