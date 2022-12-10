<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //uno a muchos
    public function products(){
        return $this->hasMany('App\Product');
    }
}
