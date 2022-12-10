<?php

namespace App;
use App\Category;
use App\Order;
use App\Product;
use App\Provider;
use App\Shipping;
use App\User;

class Factory 
{
    
    public static function create($modelo){
        if('category'==$modelo){
            return new Category();
        }
        elseif('order'==$modelo){
            return new Order();
        }
        elseif('product'==$modelo){
            return new Product();
        }
        elseif('provider'==$modelo){
            return new Provider();
        }
        elseif('shipping'==$modelo){
            return new Shipping();
        }
        elseif('user'==$modelo){
            return \Auth::user();
        }else{
            return $default = ['mensaje'=>'El modelo no existe'];
        }
    }



}