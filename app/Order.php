<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Factory;

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
        return $this->belongsToMany('App\Product','order_products');
    }

    public function getTotal(){
        $order_product = Factory::create('order_product');

        $lineas = $order_product->getProductsByOrder($this->id);
        $total= 0;

        foreach($lineas as $linea){
            $total+= $linea->subtotal;
        }
        return $total;
    }

    public function getUnitsByProduct($product_id){
        $order_product = Factory::create('order_product');

        $lineas = $order_product->getProductsByOrder($this->id);

        $producto = $lineas->where('product_id',$product_id)->get();
        $total= 0;

        // foreach($lineas as $linea){
        //     $total+= $linea->units;
        // }
        return $producto->units;
    }
  

}
