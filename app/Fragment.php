<?php

namespace App;

use App\BaseModel;
use Spatie\Translatable\HasTranslations;

class Fragment extends BaseModel
{
    //use HasTranslations;

    protected $translatable = ['text'];
}
