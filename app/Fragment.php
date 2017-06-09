<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Fragment extends Model
{
    //use HasTranslations;

    protected $translatable = ['text'];
}
