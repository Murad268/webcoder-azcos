<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\TranslateUtilityHelper;

class TranslateUtilityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('translateutility', function ($app) {
            return new TranslateUtilityHelper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
