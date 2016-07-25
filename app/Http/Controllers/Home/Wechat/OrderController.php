<?php

namespace App\Http\Controllers\Home\Wechat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CommonController;
use DB;
use App\Model\xEbuy\Order, App\Model\xEbuy\Cart, App\Model\xEbuy\Address, App\Model\xEbuy\Product, App\Models\xEbuy\OrderProduct;
use App\Model\xEbuy\Customer;
use App\Model\xEbuy\OrderAddress;
use EasyWeChat;
use Log;
use EasyWeChat\Payment\Order as WechatOrder;

class OrderController extends CommonController
{
    function __construct()
    {
        parent::__construct();
        view()->share([
            '_customer' => 'on'
        ]);
    }
    function index(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {
            $query->where('customer_id', $this->customer->id);

            switch ($request->status) {
                case '':
                    break;
                case '1':
                    $query->where('status', 1);
                    break;
                case '2':
                    $query->whereIn('status', [2, 3, 4]);
                    break;
            }
        };

        $order_status = config('xSystem.order_status');
        $orders = Order::where($where)->with('order_products.product', 'customer', 'address')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Home.wechat.order.index')
            ->with('orders', $orders)
            ->with('order_status', $order_status);
    }



    public function checkout(){
        $carts=Cart::with('product')->where('customer_id',$this->customer->id)->get();

        if($carts->isEmpty()){
            return redirect('/home/wechat/cart');
        }

        $address = Address::find(8);
        return view('Home.wechat.order.checkout')
            ->with('carts', $carts)
            ->with('count', Cart::count_cart($carts))
            ->with('address', $address);

    }

    function destroy($id)
    {
        //查出对应的商品,并将库存还回去
        $order = Order::with('order_products')->find($id);
        foreach ($order->order_products as $order_product) {
            $product = Product::find($order_product->product_id);
            //如果不是无限库存
            if ($product->stock != '-1') {
                Product::where('id', $order_product->product_id)->increment('stock', $order_product->num);
            }
        }

        //删除订单商品
        OrderProduct::where('order_id', $id)->delete();
        //删除订单地址
        OrderAddress::where('order_id', $id)->delete();
        Order::destroy($id);
        return redirect('/customer');
    }
    //生成订单
    function store(Request $request)
    {
        $count = Cart::count_cart();
        $total_price = $count['total_price'];
        $data = [];



        DB::beginTransaction();
        try {
            //生成订单
            $order = Order::create([
                'customer_id' => $this->customer->id,
                'total_price' => $total_price,
                'status' => 1
            ]);

            //订单地址
            $address = Address::find($request->address_id);
            $order->address()->create([
                'province' => $address['province'],
                'city' => $address['city'],
                'area' => $address['area'],
                'detail' => $address['detail'],
                'name' => $address['name'],
                'tel' => $address['tel'],
            ]);

            $carts = Cart::with('product')->where('customer_id', $this->customer->id)->get();
            foreach ($carts as $cart) {

                //判断库存是否足够
                if ($cart->product->stock != '-1' and $cart->product->stock - $cart->num < 0) {
                    throw new \Exception('商品' . $cart->product->name . ", 目前仅剩下" . $cart->product->stock . " 件. \n请返回购物车, 修改订单后再下单!");
                }

                //削减库存数量
                if ($cart->product->stock != '-1') {
                    $cart->product->decrement('stock', $cart->num);
                }

                //插入订单商品表
                $order->order_products()->create([
                    'product_id' => $cart->product_id,
                    'num' => $cart->num
                ]);
            }

            //清空购物车
            Cart::with('product')->where('customer_id', $this->customer->id)->delete();

        } catch (\Exception $e) {
//          echo $e->getMessage();

            DB::rollback();
            $data['status'] = 0;
            $data['info'] = $e->getMessage();
            return $data;
        }
        DB::commit();

        $data['status'] = 1;
        $data['order_id'] = $order->id;
        return $data;
    }

    function show_pay($id)
    {
        $order = Order::with('address')->find($id);

        //计算总价格, 以分为单位, 所以: *100
        $total_fre = ($order->total_price + $order->express_money) * 100;

        /**
         * 第 2 步：创建订单
         */
        $attributes = [
            'openid' => $this->customer->openid,
            'body' => '订单号:' . $order->id,
            'detail' => '长乐小卖部',
            'out_trade_no' => $order->id,
            'total_fee' => $total_fre,
            'trade_type' => 'JSAPI',
            'notify_url' => 'http://xsystem.phpwh.com/xShop/order/order_notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
        ];
        $wechat_order = new WechatOrder($attributes);

        /**
         * 第 3 步：统一下单
         */
        $payment = EasyWeChat::payment();
        $result = $payment->prepare($wechat_order);
        $prepayId = $result->prepay_id;
        $json = $payment->configForPayment($prepayId);

        return view('Home.wechat.order.show_pay')->with('order', $order)->with('json', $json);
    }

};
