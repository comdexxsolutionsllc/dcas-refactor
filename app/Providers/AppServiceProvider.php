<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        app()->bind('League\Fractal\Manager', function () {
            $fractal = new \League\Fractal\Manager;
            $serializer = new \League\Fractal\Serializer\ArraySerializer();

            $fractal->setSerializer($serializer);

            return $fractal;
        });

        app()->bind('\Dingo\Api\Transformer\Adapter\Fractal', function () {
            $fractal = app()->make('\League\Fractal\Manager');

            return new \Dingo\Api\Transformer\Adapter\Fractal($fractal);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing', 'development')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}