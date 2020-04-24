<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $guarded=[];



public function client(){

    return $this->belongTo(client::class);

}

public function products(){

        return $this->belongsToMany(product::class,'order_product');

}
}
