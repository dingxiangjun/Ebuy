<?php

namespace App\Http\Controllers\Home\Wechat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CommonController;
use App\Model\xEbuy\Product;

class CartController extends CommonController
{

    public function index(Request $request){
        return $request->all();
    }

    public function store(Request $request){

        return $request->all();
    }
  
};
