<?php

namespace App\Model\xEbuy;

use Illuminate\Database\Eloquent\Model;
use Cache;
class ProductCategory extends Model
{
	protected $guarded = [];

	public function children()
    {
        return $this->hasMany('App\Model\xEbuy\ProductCategory', 'parent_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Model\xEbuy\Product', 'category_id');
    }

    //清除缓存
    static function clear()
    {
        Cache::forget('xEbuy_category_categories');
    }

    /**
     * 生成分类数据
     * @return mixed
     */
    static function get_categories()
    {
        $categories = Cache::rememberForever('xEbuy_category_categories', function () {
            return self::with(['children' => function ($query) {
                $query->orderBy('sort_order');
            }])->where('parent_id', 0)->orderBy('sort_order')->get();
        });

        return $categories;
    }

    /**
     * 筛选分类时,屏蔽掉没有商品的分类
     */
    static function filter_categories()
    {
        $categories = self::has('children.products')->with(['children' => function ($query) {
            $query->has('products');
        }])->get();
        return $categories;
    }

    /**
     * 检查是否有子栏目
     */
    static function check_children($id)
    {
        $category = self::with('children')->find($id);
        if ($category->children->isEmpty()) {
            return true;
        }
        return false;
    }

    /**
     * 检查当前分类是否有商品
     */
    static function check_products($id)
    {
        $category = self::with('products')->find($id);
        if ($category->products->isEmpty()) {
            return true;
        }
        return false;
    }
}
