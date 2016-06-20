<?php

namespace App\Http\Controllers\Admin\xEbuy;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Controller;
use App\Model\xEbuy\Customer;

class CustomerController extends CommonController
{
	public function __construct()
    {
        parent::__construct();
        view()->share([
            '_system' => 'xEbuy',
            '_xEbuy' => 'am-in',
            '_customer' => 'am-active',
        ]);
    }
    
    function index(Request $request){

         //多条件查找
        $where = function ($query) use ($request) {
            if ($request->has('nickname') and $request->nickname != '') {
                $nickname = "%" . $request->nickname . "%";
                $query->where('nickname', 'like', $nickname);
            }

            if ($request->has('openid') and $request->openid != '') {
                $openid = "%" . $request->openid . "%";
                $query->where('openid', 'like', $openid);
            }

            if ($request->has('sex') and $request->sex != '-1') {
                $query->where('sex', $request->sex);
            }

            if ($request->has('created_at') and $request->created_at != '') {
                $time = explode(" ~ ", $request->input('created_at'));
                foreach ($time as $k => $v) {
                    $time["$k"] = $k == 0 ? $v . " 00:00:00" : $v . " 23:59:59";
                }
                $query->whereBetween('created_at', $time);
            }
        };

        $customers=Customer::where($where)->paginate(config('xSystem.page_size'));
    	return view("Admin.xEbuy.customer.index",['customers'=>$customers,'wheres'=>$where]);
    }

}
