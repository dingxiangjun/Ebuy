<?php

namespace App\Model\xEbuy;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];
    public function orders()
    {
        return $this->hasMany('App\Model\xEbuy\Order');
    }
   
}
