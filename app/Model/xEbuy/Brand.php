<?php

namespace App\Model\xEbuy;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'desc', 'url','thumb','sort_order','is_show'
    ];

    public function products()
    {
        return $this->hasMany('App\Model\xEbuy\product', 'brand_id');
    }

    /**
     * 检查当前品牌是否有商品
     */
    static public function check_products($id){
    	$brand=self::with('products')->find($id);
    	if($brand->products->isEmpty()){
    		return true;
    	}
    	return false;
    }
}
