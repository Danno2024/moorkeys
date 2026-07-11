<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (Schema::hasTable('settings')) {
            $settings = Cache::remember('app_settings', 3600, function () {
                return Setting::pluck('value', 'key')->toArray();
            });

            if (isset($settings['site_name'])) {
                config(['app.name' => $settings['site_name']]);
            }
            if (isset($settings['logo_type'])) {
                config(['app.logo_type' => $settings['logo_type']]);
            }
            if (isset($settings['site_logo'])) {
                config(['app.site_logo' => $settings['site_logo']]);
            }
            if (isset($settings['footer_text'])) {
                config(['app.footer_text' => $settings['footer_text']]);
            }

            // Load mail config from DB settings
            $mailKeys = ['mail_driver', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_address', 'mail_from_name'];
            $hasMailSettings = !empty(array_intersect($mailKeys, array_keys($settings)));

            if ($hasMailSettings) {
                $mailConfig = [
                    'driver' => $settings['mail_driver'] ?? config('mail.default'),
                    'host' => $settings['mail_host'] ?? config('mail.mailers.smtp.host'),
                    'port' => (int)($settings['mail_port'] ?? config('mail.mailers.smtp.port')),
                    'username' => $settings['mail_username'] ?? config('mail.mailers.smtp.username'),
                    'password' => $settings['mail_password'] ?? config('mail.mailers.smtp.password'),
                    'encryption' => $settings['mail_encryption'] ?? config('mail.mailers.smtp.encryption'),
                    'from' => [
                        'address' => $settings['mail_from_address'] ?? config('mail.from.address'),
                        'name' => $settings['mail_from_name'] ?? config('mail.from.name'),
                    ],
                ];
                config(['mail.default' => $mailConfig['driver']]);
                config(['mail.mailers.smtp' => array_merge(config('mail.mailers.smtp'), $mailConfig)]);
                config(['mail.from' => $mailConfig['from']]);
            }
        }
    }
}
