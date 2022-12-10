<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //muchos a muchos
    public function products(){
        return $this->belongsToMany('App\Product','product_provider');
    }


}
