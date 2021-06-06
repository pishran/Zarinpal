<?php

namespace Pishran\Zarinpal;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__.'/../config/zarinpal.php' => config_path('zarinpal.php')], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/zarinpal.php', 'zarinpal');
    }
}
