<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:1000',
            'site_keywords' => 'nullable|string|max:500',
            'logo_type' => 'nullable|in:text,image',
            'site_logo' => 'nullable|image|mimes:png,svg,jpg,jpeg,webp|max:1024',
            'site_favicon' => 'nullable|string|max:255',
            'footer_text' => 'nullable|string|max:1000',
            'contact_email' => 'nullable|email|max:255',
            'social_links' => 'nullable|array',
            'meta_global' => 'nullable|string',
            'google_analytics_id' => 'nullable|string|max:255',
            'mail_driver' => 'nullable|string|max:100',
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|integer|min:1|max:65535',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|max:50',
            'mail_from_address' => 'nullable|email|max:255',
            'mail_from_name' => 'nullable|string|max:255',
        ]);

        foreach ($data as $key => $value) {
            if (! is_null($value)) {
                Setting::set($key, is_array($value) ? json_encode($value) : $value);
            }
        }

        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('site_logo')->store('logos', 'public');
            Setting::set('site_logo', $path);
        }

        Cache::forget('app_settings');

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }

    public function maintenance()
    {
        return view('admin.settings.maintenance');
    }

    public function toggleMaintenance(Request $request)
    {
        $request->validate([
            'mode' => 'required|boolean',
            'secret' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($request->boolean('mode')) {
            $params = [];
            if ($request->filled('secret')) {
                $params['secret'] = $request->secret;
            }
            if ($request->filled('message')) {
                $params['retry'] = $request->message;
            }
            app()->maintenanceMode()->activate($params);
        } else {
            app()->maintenanceMode()->deactivate();
        }

        return back()->with('success', 'Maintenance mode ' . ($request->boolean('mode') ? 'enabled' : 'disabled') . '.');
    }

    public function reinstall()
    {
        return view('admin.settings.reinstall');
    }

    public function reinstallConfirm(Request $request)
    {
        $request->validate([
            'confirm' => 'required|accepted',
        ]);

        try {
            // Drop all tables
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $tables = DB::select('SHOW TABLES');
            foreach ($tables as $table) {
                $tableName = array_values((array)$table)[0];
                DB::statement("DROP TABLE IF EXISTS `{$tableName}`");
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // Remove installed marker
            if (File::exists(storage_path('installed'))) {
                File::delete(storage_path('installed'));
            }

            // Clear all caches
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            Artisan::call('cache:clear');

            return redirect()->route('install.welcome')->with('success', 'System reset complete. Redirecting to installer...');
        } catch (\Exception $e) {
            return back()->withErrors(['reinstall' => 'Reinstall failed: ' . $e->getMessage()]);
        }
    }
}
