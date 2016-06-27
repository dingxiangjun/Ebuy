<?php

namespace App\Model\xAd;

use Illuminate\Database\Eloquent\Model;
use Cache;
class AdCategory extends Model
{

    protected $guarded = [];
    
    public function ads()
    {
        return $this->hasMany('App\Model\xAd\Ad', 'category_id');
    }
    //清除缓存
    static function clear()
    {
        Cache::forget('xAd_ad_categories');
    }
    
     /**
     * 生成分类数据
     * @return mixed
     */
    static function get_categories(){
        $categories = Cache::rememberForever('xAd_ad_categories', function () {
            return self::orderBy('sort_order')->get();
        });
        return $categories;
    }

      /**
     * 检查是否有广告
     */
    static function check_ads($id)
    {
        $category = self::with('ads')->find($id);
        if ($category->ads->isEmpty()) {
            return true;
        }
        return false;
    }
}
