<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    //uno a muchos
    public function orders(){
        return $this->hasMany('App\Order');
    }
}
