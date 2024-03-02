<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EasyFormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        \App::bind('easyform', function()
        {
            return new \App\Helpers\EasyForm;

        });
    }
}
