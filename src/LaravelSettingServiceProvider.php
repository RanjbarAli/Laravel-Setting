<?php

namespace RanjbarAli\LaravelSetting;

include_once(__DIR__.'/helpers.php');

use Illuminate\Support\ServiceProvider;

class LaravelSettingServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
         $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-setting.php', 'laravel-setting');
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-setting.php', 'laravel-setting');

        // Register the service the package provides.
        $this->app->singleton('laravel-setting', function ($app) {
            return new LaravelSetting;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-setting'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-setting.php' => config_path('laravel-setting.php'),
        ], 'laravel-setting.config');

        $this->publishes([
            realpath(__DIR__.'/migrations') => database_path('migrations')
        ], 'migrations');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/ranjbarali'),
        ], 'laravel-setting.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/ranjbarali'),
        ], 'laravel-setting.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/ranjbarali'),
        ], 'laravel-setting.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
