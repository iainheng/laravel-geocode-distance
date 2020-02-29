<?php

namespace Nextbyte\Distance;

use Illuminate\Support\ServiceProvider;

class GeocodeDistanceServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/distance.php' => config_path('distance.php'),
                __DIR__.'/../config/googlemaps.php' => config_path('googlemaps.php'),
            ], 'config');
        }

        $this->mergeConfigFrom(__DIR__.'/../config/distance.php', 'distance');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('geocode-distance', function ($app) {
            return new DistanceManager($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['geocode-distance'];
    }
}
