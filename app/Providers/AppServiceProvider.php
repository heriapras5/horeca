<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            $settings = Setting::pluck('value', 'key')->toArray();
        } catch (\Exception $e) {
            $settings = [];
        }

        $logo = !empty($settings['logo'])
            ? (Str::startsWith($settings['logo'], 'http') ? $settings['logo'] : asset('storage/'.$settings['logo']))
            : null;

        $favicon = !empty($settings['favicon'])
            ? (Str::startsWith($settings['favicon'], 'http') ? $settings['favicon'] : asset('storage/'.$settings['favicon']))
            : null;

        $siteName = $settings['site_name'] ?? '';

        view()->share('_globalSettings', $settings);
        view()->share('_globalLogo', $logo);
        view()->share('_globalFavicon', $favicon);
        view()->share('_globalSiteName', $siteName);
    }
}
