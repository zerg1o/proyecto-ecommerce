<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{
    public function getProductsByOrderAndProduct($order_id,$product_id){
        return $this->where('order_id',$order_id)
                    ->where('product_id',$product_id)
                    ->orderBy('id','desc')->first();
    }

    public function getProductsByOrder($order_id){
        return $this->where('order_id',$order_id)
                    ->orderBy('id','desc')->get();
    }

}

