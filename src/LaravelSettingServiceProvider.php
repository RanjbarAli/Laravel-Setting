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
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
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
        $this->publishes([
            __DIR__.'/../config/laravel-setting.php' => config_path('laravel-setting.php'),
        ], 'config');

        $this->publishes([
            realpath(__DIR__.'/../database/migrations') => database_path('migrations')
        ], 'migrations');
    }
}
