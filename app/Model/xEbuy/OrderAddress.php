<?php

namespace App\Model\xEbuy;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'order_address';
}
