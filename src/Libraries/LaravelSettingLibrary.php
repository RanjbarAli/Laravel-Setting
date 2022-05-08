<?php

namespace RanjbarAli\LaravelSetting\Libraries;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use RanjbarAli\LaravelSetting\LaravelSetting as LaravelSettingModel;

class LaravelSettingLibrary
{

    protected $setting  = [];
    protected $key      = null;
    public $value       = null;

    public function __construct($key = null)
    {
        $this->initialize();
        $this->key = $key;
        $this->value = $key? $this->get($key) : $this->setting;
    }

    protected function initialize()
    {
        $this->setting = Cache::remember(
            config('laravel-setting.cache_key'),
            config('laravel-setting.cache_time'),
            function () {
                return LaravelSettingModel::all()->pluck('value', 'option');
            }
        );
    }

    public function restart()
    {
        Cache::forget( config('laravel-setting.cache_key') );
        $this->initialize();
        return $this;
    }

    private function select($option)
    {
        return $this->setting[$option] ?? null;
    }

    private function get($option)
    {
        if (is_array($option)):
            $result = [];
            foreach ($option as $item):
                $result[$item] = $this->select($item);
            endforeach;
            return $result;
        else:
            return $this->select($option);
        endif;
    }

    public function set($value): bool
    {
        if (!is_string($this->key))
            return false;
        $update = LaravelSettingModel::where('option', $this->key)->update([ 'value' => $value ]);
        $this->restart();
        return $update;
    }

    public function add($option, $value, $type = 'string') {
        $insert = LaravelSettingModel::insert([
            'option' => $option,
            'value'  => $value,
            'type'   => $type
        ]);
        $this->restart();
        return $insert;
    }

    public function delete() {
        $delete = LaravelSettingModel::where('option', $this->key)->delete();
        $this->restart();
        return $delete;
    }

    public function is($value): bool
    {
        return $this->value == $value;
    }

    public function is_exactly($value): bool
    {
        return $this->value === $value;
    }

    public function exists(): bool
    {
        return $this->value !== null;
    }

}
