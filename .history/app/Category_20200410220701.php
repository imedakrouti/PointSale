<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable; // 2. To add translation methods

    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['name'];
}
