<?php

namespace App\Http\Controllers\Home\Wechat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CommonController;
use App\Model\xEbuy\Product;

class ProductController extends CommonController
{

    public function show($id){
        $product=Product::find($id);

        $recommends=Product::where('is_recommend',true)
                            ->where('id','<>',$id)
                            ->take(4)
                            ->orderBy('is_top', 'desc')
                            ->get(); 
        return view('Home.Wechat.product.show')
                            ->with('product', $product)
                            ->with('recommends', $recommends);
    }
  
};
