<?php

namespace RanjbarAli\LaravelSetting;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class LaravelSetting extends Model
{

    protected $table = 'settings';

    public $timestamps = false;

    protected $fillable = ['option','value'];

    public function value(): Attribute
    {
        return new Attribute(
            get: fn($value) => match (mb_strtolower($this->type)) {
                'float' => (float)$value,
                'integer' => (integer)$value,
                'boolean' => (boolean)$value,
                'array' => unserialize($value),
                default => (string)$value,
            },
            set: function ($value) {
                return mb_strtolower($this->type) != 'array' ? $value : (string)serialize((array)$value);
            }
        );
    }
}
