<?php

namespace App\Model\xEbuy;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded = [];
    
    public function express()
    {
        return $this->belongsTo('App\Model\xEbuy\Express');
    }

    public function customer()
    {
        return $this->belongsTo('App\Model\xEbuy\Customer');
    }

    public function order_products()
    {
        return $this->hasMany('App\Model\xEbuy\OrderProduct');
    }

    public function address()
    {
        return $this->hasOne('App\Model\xEbuy\OrderAddress');
    }

}
