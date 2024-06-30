<?php

namespace App\Providers;

use App\Helpers\LangRouteHelper;
use Illuminate\Support\ServiceProvider;

class LangChangeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('langchangeutility', function ($app) {
            return new LangRouteHelper();
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
