<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Factory;

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
        return $this->belongsToMany('App\Order','order_products');
    }

    public function getUnitsByProduct($order_id){
        $order_product = Factory::create('order_product');

        $linea = $order_product->getProductsByOrderAndProduct($order_id,$this->id);

        // dd($linea);
        $total= $linea->units;

        // foreach($lineas as $linea){
        //     $total+= $linea->units;
        // }
        return $total;
    }


}
