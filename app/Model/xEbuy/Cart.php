<?php

namespace App\Model\xEbuy;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public function products()
    {
        return $this->hasMany('App\Model\xEbuy\product', 'brand_id');
    }
    
}
