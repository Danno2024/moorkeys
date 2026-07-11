@extends('admin.layouts.app')
@section('title', 'Settings')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Settings</h1>
    <p class="text-gray-600 mt-1">Manage global website settings and SEO.</p>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">General Settings</h2>
            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Site Name</label><input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? config('app.name')) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
                    <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Site Description</label><textarea name="site_description" rows="3" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea></div>
                    <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Site Keywords</label><input type="text" name="site_keywords" value="{{ old('site_keywords', $settings['site_keywords'] ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label><input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Google Analytics ID</label><input type="text" name="google_analytics_id" value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
                    <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Footer Text</label><textarea name="footer_text" rows="2" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('footer_text', $settings['footer_text'] ?? '') }}</textarea></div>
                </div>

                <div class="border-t border-gray-200 pt-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Site Logo</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Logo Type</label>
                            <div class="flex items-center gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="logo_type" value="text" {{ ($settings['logo_type'] ?? 'text') === 'text' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm text-gray-700">Text Logo (uses site name)</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="logo_type" value="image" {{ ($settings['logo_type'] ?? '') === 'image' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm text-gray-700">Image Logo</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Logo</label>
                            @if(!empty($settings['site_logo']) && Storage::disk('public')->exists($settings['site_logo']))
                            <div class="mb-3 p-4 bg-gray-50 rounded-lg border border-gray-200 inline-block">
                                <img src="{{ Storage::url($settings['site_logo']) }}" alt="Current logo" class="max-h-12">
                                <p class="text-xs text-gray-500 mt-1">Current logo</p>
                            </div>
                            @endif
                            <input type="file" name="site_logo" accept="image/png,image/svg+xml,image/jpeg,image/webp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="text-xs text-gray-500 mt-1">Recommended size: 200x50px or similar aspect ratio. Accepted: PNG, SVG, JPG, WebP (max 1MB)</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">SMTP / Mail Settings</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Mail Driver</label><select name="mail_driver" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="smtp" {{ ($settings['mail_driver'] ?? 'smtp') === 'smtp' ? 'selected' : '' }}>SMTP</option><option value="sendmail" {{ ($settings['mail_driver'] ?? '') === 'sendmail' ? 'selected' : '' }}>Sendmail</option><option value="log" {{ ($settings['mail_driver'] ?? '') === 'log' ? 'selected' : '' }}>Log (local dev)</option></select></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Host</label><input type="text" name="mail_host" value="{{ old('mail_host', $settings['mail_host'] ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Port</label><input type="number" name="mail_port" value="{{ old('mail_port', $settings['mail_port'] ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Encryption</label><select name="mail_encryption" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"><option value="" {{ empty($settings['mail_encryption']) ? 'selected' : '' }}>None</option><option value="tls" {{ ($settings['mail_encryption'] ?? '') === 'tls' ? 'selected' : '' }}>TLS</option><option value="ssl" {{ ($settings['mail_encryption'] ?? '') === 'ssl' ? 'selected' : '' }}>SSL</option></select></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Username</label><input type="text" name="mail_username" value="{{ old('mail_username', $settings['mail_username'] ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">Password</label><input type="password" name="mail_password" value="{{ old('mail_password', $settings['mail_password'] ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">From Address</label><input type="email" name="mail_from_address" value="{{ old('mail_from_address', $settings['mail_from_address'] ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
                        <div><label class="block text-sm font-medium text-gray-700 mb-1">From Name</label><input type="text" name="mail_from_name" value="{{ old('mail_from_name', $settings['mail_from_name'] ?? '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-sm font-medium text-gray-700 mb-3">Quick Links</h3>
            <div class="space-y-2">
                <a href="{{ route('admin.settings.maintenance') }}" class="block w-full text-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm">Maintenance Mode</a>
            </div>
        </div>
    </div>
</div>
@endsection
