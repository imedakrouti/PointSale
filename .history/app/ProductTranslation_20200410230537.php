<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    protected $fillable = ['name','description'];
    public $timestamps = false;
}
