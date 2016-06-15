<?php

namespace App\Model\xEbuy;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'desc', 'url','thumb','sort_order','is_show'
    ];
}
