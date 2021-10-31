<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
<<<<<<< HEAD
        if (env('APP_ENV') == 'production') {
            URL::forceScheme('https');
        }
=======
	if (app()->env === "production") {
		//URL::forceScheme('https');
	}
>>>>>>> cb63bbfdbd93c2f36365b7caba68345315a3834c
    }
}
