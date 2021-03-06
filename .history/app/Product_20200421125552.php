<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// 1. To specify package’s class you are using
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Product extends Model
{
    use Translatable; // 2. To add translation methods

    // 3. To define which attributes needs to be translated

    public $translatedAttributes = ['name','description'];
    //protected $fillable=['category_id','image','purchase_price','sale_price','stock'];
    protected $guarded=['name','description'];
    //protected $guarded=[];
    protected $appends=['image_path','gains'];

    public function getImagePathAttribute(){
        return asset('uploads/product-images/'.$this->image);
    }

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function getNameAttribute($value){
        return ucfirst($value);
    }

    public function getGainSAttribute(){
        $gain = $this->sale_price - $this->purchase_price;
        $gain_percent = $gain * 100 / $this->purchase_price;
        return number_format($gain_percent, 2);
    }

    public function orders(){

        return $this->belongsToMany(order::class,'order_product');

}

}
