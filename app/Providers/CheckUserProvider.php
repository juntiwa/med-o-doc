<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CheckUserProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\CheckUserAPI', env('CHECK_USER_API', 'App\APIs\CheckUserAPI'));
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
