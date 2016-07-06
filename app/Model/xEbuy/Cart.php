<?php

namespace App\Model\xEbuy;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo('App\Model\xEbuy\Customer');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\xEbuy\Product');
    }

    /**
     * 计算购物车总价和数量
     */
    static function count_cart($carts = null)
    {
        $count = [];
        
/*        $customer = session()->get('customer');*/
        //避免重复查询数据
        $carts = $carts ? $carts : Cart::with('product')->where('customer_id', 1)->get();

        $total_price = 0;
        $num = 0;
        foreach ($carts as $v) {
            $total_price += $v->product->price * $v->num;
            $num += $v->num;
        }

        $count['total_price'] = $total_price;
        $count['num'] = $num;

        return $count;
    }
    
}
