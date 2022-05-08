<?php

use RanjbarAli\LaravelSetting\Libraries\LaravelSettingLibrary;

function setting($key = null): LaravelSettingLibrary
{
    return new LaravelSettingLibrary($key);
}
