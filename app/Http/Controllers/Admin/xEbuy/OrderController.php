<?php

namespace App\Http\Controllers\Admin\xEbuy;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Controller;
use App\Model\xEbuy\Order;
use App\Model\xEbuy\Customer;
use App\Model\xEbuy\OrderAddress;
use App\Model\xEbuy\Express;

class OrderController extends CommonController
{
	public function __construct()
    {
        parent::__construct();
        view()->share([
            '_system' => 'xEbuy',
            '_xEbuy' => 'am-in',
            '_order' => 'am-active',
            'order_status' => config('xSystem.order_status'),
        ]);
    }
    
    public function index(Request $request){
       
        //多条件查找
        $where = function ($query) use ($request) {
            if ($request->has('id') and $request->id != '') {
                $query->where('id', $request->id);
            }

            if ($request->has('customer_id') and $request->customer_id != '') {
                $query->where('customer_id', $request->customer_id);
            }

            if ($request->has('total_price') and $request->total_price != '') {

                $status = is_numeric($request->total_price) ? '=' : substr($request->total_price, 0, 1);
                $total_price = substr($request->total_price, 1);

                switch ($status) {
                    case '>':
                        $query->where('total_price', '>=', $total_price);
                        break;
                    case '<' :
                        $query->where('total_price', '<=', $total_price);
                        break;
                    //用户直接输入的是金额,那么就等于
                    default:
                        $query->where('total_price', $request->total_price);
                }
            }
            
            if ($request->has('status') and $request->status != '-1') {
                $query->where('status', $request->status);
            }
            
            if ($request->has('created_at') and $request->created_at != '') {
                $time = explode(" ~ ", $request->input('created_at'));
                foreach ($time as $k => $v) {
                    $time["$k"] = $k == 0 ? $v . " 00:00:00" : $v . " 23:59:59";
                }
                $query->whereBetween('created_at', $time);
            }
            
        };

        $orders = Order::where($where)
            ->with('order_products.product', 'customer', 'address')
            ->orderBy('created_at', 'desc')
            ->paginate(config('xSystem.page_size'));
        return view('Admin.xEbuy.order.index')->with('orders', $orders);
    }

    public function show($id){
        $expresses = Express::orderBy('sort_order')->get();
        $order=Order::with('order_products.product','customer','address','express')->find($id);
       
        return view('Admin.xEbuy.order.show')->with(['expresses'=>$expresses,'order'=>$order]);
    }

    
}
