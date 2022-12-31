<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //muchos a uno

    public function user(){
        return $this->belongsTo('App\User','user_id'); 
    }

    public function shipping(){
        return $this->belongsTo('App\Shipping','shipping_id');
    }

    //muchos a muchos
    public function products(){
        return $this->belongsToMany('App\Product','order_product');
    }
}
