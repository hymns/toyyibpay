<?php

namespace Hymns\ToyyibPay;

use Illuminate\Support\ServiceProvider;

class ToyyibPayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/toyyibpay.php',
            'toyyibpay'
        );

        $this->publishes([
            __DIR__ . '/config/toyyibpay.php' => config_path('toyyibpay.php')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ToyyibPay', function ($app) {

            return new ToyyibPay(
                config('toyyibpay.client_secret'),
                config('toyyibpay.redirect_uri'),
                config('toyyibpay.production_mode')
            );
        });
    }
}
