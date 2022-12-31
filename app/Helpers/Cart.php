<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Cart {

    public static function getTotal() {
        $cart = session()->get('cart');
        $total = 0;
        foreach($cart as $key => $item){
            
            $total= $total + ($item['quantity'] * $item['price']);

        }

        return $total;

    }
}

