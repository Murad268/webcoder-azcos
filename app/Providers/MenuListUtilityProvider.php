<?php

namespace App\Providers;

use App\Helpers\MenuHelper;
use App\Services\Parameters\ParameterService;
use Illuminate\Support\ServiceProvider;

class MenuListUtilityProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('menulistutility', function ($app) {
            $parameterService = $app->make(ParameterService::class);
            return new MenuHelper($parameterService);
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
