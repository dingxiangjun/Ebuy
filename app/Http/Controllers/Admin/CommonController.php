<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    function __construct()
    {
        $admin = \Auth::user();
        view()->share([
            'admin' => $admin,
            'systems'   => config('xSystem.systems'),
        ]);
        $this->bibel();
    }

    //思考, 源自Holy Bible
    private function bibel()
    {
        @$bibels = file('Bibel.txt');
        $size = count($bibels) / 2 - 1;
        $rand = rand(0, $size) * 2;
        $bibel = array(
            'cn' => $bibels[$rand + 1],
            'en' => $bibels[$rand]
        );

        view()->share('bibel', $bibel);
    }
}
