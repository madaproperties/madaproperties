<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . DIRECTORY_SEPARATOR . 'helper' . DIRECTORY_SEPARATOR . 'helpers.php';
        require_once app_path() . DIRECTORY_SEPARATOR . 'helper' . DIRECTORY_SEPARATOR . 'xmlFunctions.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
