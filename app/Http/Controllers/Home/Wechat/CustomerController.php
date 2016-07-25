<?php

namespace App\Http\Controllers\Home\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\CommonController;
use App\Http\Requests;

class CustomerController extends CommonController
{
    function __construct()
    {
        parent::__construct();
        view()->share([
            '_customer' => 'on',
            'headimgurl' => $this->customer->headimgurl,
        ]);
    }

    function index()
    {
        return view('Home.wechat.customer.index');
    }
}