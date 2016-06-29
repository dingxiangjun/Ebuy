<?php

namespace App\Http\Controllers\Home\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CommonController;
use App\Model\xAd\Ad, App\Model\xEbuy\Product;

class IndexController extends CommonController
{

    function index(){
        //广告
        $slides = Ad::where('category_id', '1')->orderBy("sort_order")->get();
        $banners = Ad::where('category_id', '2')->orderBy("sort_order")->get();
        //推荐商品
        $recommends = Product::where('is_recommend', true)->orderBy('is_top', 'desc')->orderBy('sort_order')->get();
        return view('Home.wechat.index')
            ->with('slides', $slides)
            ->with('banners', $banners)
            ->with('recommends', $recommends)
            ->with('_index', 'on');
    }
  
  
}
