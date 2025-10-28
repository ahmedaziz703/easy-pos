<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {     
        try {

            if (!Schema::hasTable('settings')) {
                return;
            }
            $settings = Setting::pluck('value', 'key')->toArray();
            config()->set('settings', $settings);

        }catch (\Throwable $th) {
        }
    }
}   
