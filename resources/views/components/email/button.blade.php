@props(['url', 'text', 'color' => 'indigo', 'style' => 'primary'])

@php
    $colors = [
        'primary' => ['indigo' => 'bg-indigo-600 hover:bg-indigo-700', 'blue' => 'bg-blue-600 hover:bg-blue-700', 'green' => 'bg-green-600 hover:bg-green-700', 'red' => 'bg-red-600 hover:bg-red-700', 'yellow' => 'bg-yellow-600 hover:bg-yellow-700'],
        'outline' => ['indigo' => 'bg-white border-indigo-600 text-indigo-600 hover:bg-indigo-50', 'blue' => 'bg-white border-blue-600 text-blue-600 hover:bg-blue-50', 'green' => 'bg-white border-green-600 text-green-600 hover:bg-green-50'],
    ];
    $btnClass = $colors[$style][$color] ?? $colors['primary']['indigo'];
@endphp

<a href="{{ $url }}" style="display: inline-block; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; {{ $style === 'primary' ? 'color: #fff;' : '' }} {{ $btnClass }}" class="{{ $btnClass }}">
    {{ $text }}
</a>