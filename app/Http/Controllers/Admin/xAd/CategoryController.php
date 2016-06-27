<?php
namespace App\Http\Controllers\Admin\xAd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;

class CategoryController extends CommonController
{

	public function __construct()
    {
        parent::__construct();
        view()->share([
            '_system' => 'xAd',
            '_index' => 'am-active',
        ]);
    }

    function index(){
    	
        return view('Admin.xAd.category.index');
    }


  
}
