<?php

namespace Secrethash\Trickster;

use Illuminate\Support\ServiceProvider;
 
use Symfony\Component\Finder\Finder;

use Illuminate\Filesystem\Filesystem;


class TricksterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // loading the routes
        // require __DIR__ . "/Http/routes.php";
        $this->publishes([
        __DIR__.'./config/trickster.php' => config_path('trickster.php'),
        ]);       
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
        __DIR__.'./config/trickster.php', 'trickster'
        );
        include __DIR__ . "/Http/routes.php";
        $this->app->make('Secrethash\Trickster\Http\TricksController');
        //
        $this->app->bind('trickster', function($app) {
            return new Http\TricksController;
        });
    }

}
