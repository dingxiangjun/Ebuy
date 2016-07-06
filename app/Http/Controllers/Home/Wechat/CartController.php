<?php

namespace App\Http\Controllers\Home\Wechat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CommonController;
use App\Model\xEbuy\Product;
use App\Model\xEbuy\Cart;

class CartController extends CommonController
{

    public function index(){
        $carts = Cart::with('product')->where('customer_id', 1)->get();
        //return $carts;
        return view('Home.wechat.cart.index')
            ->with('carts', $carts)
            ->with('count', Cart::count_cart($carts));
    }

    public function store(Request $request)
    {
        //return $request->all();
        //判断购物车是否有当前商品,如果有,那么 num +1
        $product_id = $request->product_id;
        $cart = Cart::where('product_id', $product_id)->where('customer_id', 1)->first();

        if ($cart) {
            Cart::where('id', $cart->id)->increment('num');
            return;
        }

        //否则购物车表,创建新数据
        Cart::create([
            'product_id' => $request->product_id,
            'customer_id' => 1,
        ]);
    }

    function change_num(Request $request)
    {
        if ($request->type == 'add') {
            Cart::where('id', $request->id)->increment('num');
        } else {
            Cart::where('id', $request->id)->decrement('num');
        }
        return Cart::count_cart();
    }
  
};
