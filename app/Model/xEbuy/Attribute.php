<?php

namespace App\Model\xEbuy;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $guarded = [];
    
    public function product_categories()
    {
        return $this->belongsTo('App\Model\xEbuy\ProductCategory');
    }
   
}
