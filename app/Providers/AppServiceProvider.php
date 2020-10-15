<?php

namespace App\Providers;

use App\Http\Kernel;
use App\Http\Resources\AppJsonResource;
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
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        AppJsonResource::withoutWrapping();

        // swagger autogen:
        $this->app->singleton('L5Swagger\Http\Controllers\SwaggerController', function($app) {
            return new \App\Http\Controllers\SwaggerController($app->make('L5Swagger\GeneratorFactory'));
        });
    }
}
