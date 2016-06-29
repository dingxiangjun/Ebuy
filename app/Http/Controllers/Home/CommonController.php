<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    function __construct()
    {
        view()->share([
            'admin' => 111,
            'systems'   => 222,
            
        ]);
    }

}
