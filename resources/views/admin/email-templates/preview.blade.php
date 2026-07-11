<x-email.layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 16px;">
            <h2 style="margin: 0; font-size: 18px; font-weight: 600; color: #1f293b;">{{ $emailTemplate->name }}</h2>
            <span style="font-size: 12px; color: #6b7280;">Subject: {{ $emailTemplate->subject }}</span>
        </div>
    </x-slot>

    <x-slot name="footer">
        <div style="text-align: center;">
            <a href="{{ route('admin.email-templates.edit', $emailTemplate) }}" style="font-size: 12px; color: #4f46e5; text-decoration: none;">Edit Template</a>
            <span style="margin: 0 8px; color: #d1d5db;">|</span>
            <a href="{{ route('admin.email-templates.index') }}" style="font-size: 12px; color: #6b7280; text-decoration: none;">← Back to List</a>
        </div>
    </x-slot>

    <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 24px;">
        {!! $emailTemplate->body !!}
    </div>
</x-email.layout>