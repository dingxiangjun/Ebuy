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

    public function order_products()
    {
        return $this->hasMany('App\Model\xEbuy\OrderProduct');
    }

     //一个商品有很多相册图片
    public function product_galleries()
    {
        return $this->hasMany('App\Model\xEbuy\ProductGallery');
    }

    //检查当前商品是否有订单
    static function check_orders($id)
    {
        $product = self::with('order_products')->find($id);
        if ($product->order_products->isEmpty()) {
            return true;
        }
        return false;
    }
}
