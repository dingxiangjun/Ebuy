<?php

namespace App\Model\xEbuy;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo('App\Model\xEbuy\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\xEbuy\Product');
    }
}
