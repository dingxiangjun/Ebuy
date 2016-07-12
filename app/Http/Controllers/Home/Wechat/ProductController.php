<?php

namespace App\Http\Controllers\Home\Wechat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CommonController;
use App\Model\xEbuy\Product;
use App\Model\xEbuy\ProductCategory as Category;

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

    function index(Request $request)
    {
        $where = function ($query) use ($request) {
            if ($request->has('category_id') and $request->category_id != '') {
                $query->where('category_id', $request->category_id);
            }

            if ($request->has('searchword')) {
                if ($request->has('searchword') and $request->searchword != '') {
                    $search = "%" . $request->searchword . "%";
                    $query->where('name', 'like', $search);
                }
            }
        };

        $products = Product::where($where)
            ->orderBy('is_top', "desc")
            ->orderBy('created_at')
            ->get();
        //return $products;
        return view('Home.wechat.product.index')->with('products', $products);
    }

    function category()
    {
        $categories = Category::get_categories();
        return view('Home.wechat.product.category')->with('categories', $categories);
    }

    function search()
    {
        $products = Product::where('is_recommend', true)
            ->orderBy('is_top', "desc")
            ->orderBy('created_at')
            ->get();
        return view('Home.wechat.product.search')->with('products', $products);
    }
  
};
