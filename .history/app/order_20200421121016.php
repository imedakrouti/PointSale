<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $guarded=[];
}


public function user(){

    return $this->belongTo(user::class);
}
