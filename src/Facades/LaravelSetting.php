<?php

namespace RanjbarAli\LaravelSetting\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelSetting extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-setting';
    }
}
