<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    //muchos a muchos
    public function providers(){
        return $this->belongsToMany('App\Provider','product_provider');
    }

    //muchos a uno
    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }

    //muchos a muchos
    public function orders(){
        return $this->belongsToMany('App\Order','order_product');
    }


}
