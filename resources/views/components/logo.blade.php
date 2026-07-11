@props(['class' => 'text-gray-900'])
@php
    $logoType = config('app.logo_type', 'text');
    $logoPath = config('app.site_logo');
    $useImage = $logoType === 'image' && $logoPath && \Illuminate\Support\Facades\Storage::disk('public')->exists($logoPath);
@endphp
@if($useImage)
    <img src="{{ Storage::url($logoPath) }}" alt="{{ config('app.name') }}" class="max-h-10 w-auto {{ $class }}">
@else
    <span class="text-xl font-bold {{ $class }}">{{ config('app.name') }}</span>
@endif
