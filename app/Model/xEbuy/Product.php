<?php

namespace App\Model\xEbuy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = ['editorValue'];


    //每个商品都属于某一个品牌
    public function brand()
    {
        return $this->belongsTo('App\Model\xEbuy\Brand');
    }

    //每个商品都属于某一个分类
    public function category()
    {
        return $this->belongsTo('App\Model\xEbuy\ProductCategory');
    }

}
