<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview: {{ $invoiceTemplate->name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f3f4f6; }
        .toolbar { background: #fff; border-bottom: 1px solid #e5e7eb; padding: 12px 24px; display: flex; align-items: center; gap: 12px; position: sticky; top: 0; z-index: 10; }
        .toolbar h2 { font-size: 14px; font-weight: 600; color: #374151; }
        .toolbar a { margin-left: auto; font-size: 13px; color: #4f46e5; text-decoration: none; }
        .toolbar a:hover { text-decoration: underline; }
        .invoice-container { max-width: 800px; margin: 24px auto; background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; }
        .invoice-body { padding: 40px; }
        .invoice-footer { padding: 20px 40px; border-top: 1px solid #e5e7eb; font-size: 12px; color: #6b7280; }
        .invoice-terms { padding: 20px 40px; border-top: 1px solid #e5e7eb; font-size: 13px; color: #374151; }
    </style>
</head>
<body>
    <div class="toolbar">
        <h2>{{ $invoiceTemplate->name }}</h2>
        <span style="font-size:13px;color:#6b7280;">Subject: {{ $invoiceTemplate->subject }}</span>
        <a href="{{ route('admin.invoice-templates.edit', $invoiceTemplate) }}">Edit Template</a>
        <a href="{{ route('admin.invoice-templates.index') }}">&larr; Back</a>
    </div>
    <div class="invoice-container">
        <div class="invoice-body">
            {!! $invoiceTemplate->body !!}
        </div>
        @if($invoiceTemplate->footer_text)
        <div class="invoice-footer">{!! nl2br(e($invoiceTemplate->footer_text)) !!}</div>
        @endif
        @if($invoiceTemplate->terms)
        <div class="invoice-terms"><strong>Terms &amp; Conditions</strong><br>{!! nl2br(e($invoiceTemplate->terms)) !!}</div>
        @endif
    </div>
</body>
</html>
