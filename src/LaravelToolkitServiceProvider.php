<?php

namespace Danieletulone\LaravelToolkit;

use Illuminate\Support\ServiceProvider;

class LaravelToolkitServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'toolkit');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'toolkit');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('laravel-toolkit.php'),
            ], 'config');

            $this->commands([
                \Danieletulone\LaravelToolkit\Console\Commands\DbTranslatableCommand::class,
                \Danieletulone\LaravelToolkit\Console\Commands\DbCloneCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravel-toolkit');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-toolkit', function () {
            return new LaravelToolkit;
        });
    }
}
