<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class MenuShippingInfo extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [];
    protected $translatable = ['city'];

    protected static function newFactory()
    {
        return \Modules\Restaurant\Database\factories\MenuShippingInfoFactory::new();
    }
}