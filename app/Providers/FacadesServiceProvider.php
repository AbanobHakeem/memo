<?php

namespace App\Providers;
use App;
use Illuminate\Support\Facades\App as FacadesApp;
use Illuminate\Support\ServiceProvider;

class FacadesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        FacadesApp::bind('Images',function() {
            return new App\Facades\Images;
         });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
