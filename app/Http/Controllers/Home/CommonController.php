<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class CommonController extends Controller
{
	protected $customer;
    public function __construct()
    {
        $this->customer = session()->get('customer');
    }

}
