<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Spotify;

class SpotifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Spotify::class, function ()  {
          return new Spotify();
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
