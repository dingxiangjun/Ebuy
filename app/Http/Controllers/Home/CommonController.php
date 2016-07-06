<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function __construct()
    {
        $this->customer = session()->get('customer');
    }

}
