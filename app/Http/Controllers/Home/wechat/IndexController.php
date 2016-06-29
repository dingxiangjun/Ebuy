<?php

namespace App\Http\Controllers\Home\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CommonController;

class IndexController extends CommonController
{

	public function __construct()
    {
        parent::__construct();
        view()->share([
            '_system' => 'xEbuy',
            '_index' => 'am-active',
        ]);
    }

    function index(){
        
        return view('Home.wechat.index');
    }
  
  
}
