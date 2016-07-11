<?php

namespace App\Http\Controllers\Home\Wechat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CommonController;
use App\Model\xEbuy\Product;
use App\Model\xEbuy\Cart;
use App\Model\xEbuy\Address;

class OrderController extends CommonController
{

    public function checkout(){
        $carts=Cart::with('product')->where('customer_id',1)->get();

        if($carts->isEmpty()){
            return redirect('/home/wechat/cart');
        }

        $address = Address::find(8);
        return view('Home.wechat.order.checkout')
            ->with('carts', $carts)
            ->with('count', Cart::count_cart($carts))
            ->with('address', $address);

    }

   
    
  
};
