<?php

namespace App\Http\Controllers\Admin\xApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use DB, Cache;
use App\Model\xEbuy\Order, App\Model\xEbuy\OrderProduct;

class VisualizationController extends Controller
{
    //本周起止时间unix时间戳
    private $week_start;
    private $week_end;

    //本月起止时间unix时间戳
    private $month_start;
    private $month_end;

    function __construct()
    {
        $this->week_start = mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y"));
        $this->week_end = mktime(23, 59, 59, date("m"), date("d") - date("w") + 7, date("Y"));

        $this->month_start = mktime(0, 0, 0, date("m"), 1, date("Y"));
        $this->month_end = mktime(23, 59, 59, date("m"), date("t"), date("Y"));
    }

    /**
     * 本周销售额
     * @return array
     */
    function sales_amount()
    {
       /* return Cache::remember('xApi_visualization_sales_amount', 1, function () {*/
            $amount = [];
            for ($i = 0; $i < 7; $i++) {
                $start = date('Y-m-d H:i:s', strtotime("+" . $i . " day", $this->week_start));
                $end = date('Y-m-d H:i:s', strtotime("+" . ($i + 1) . " day", $this->week_start));
                $amount['create'][] = Order::whereBetween('created_at', [$start, $end])->where('status', 1)->sum('total_price');
                $amount['pay'][] = Order::whereBetween('pay_time', [$start, $end])->where('status', '>', 1)->sum('total_price');
            }

            $data = [
                'week_start' => date("Y年m月d日", $this->week_start),
                'week_end' => date("Y年m月d日", $this->week_end),
                'amount' => $amount,
            ];
            return $data;
      /* });*/
    }

    /**
     * 本周销量
     * @return array
     */
    function sales_count()
    {
        return Cache::remember('xApi_visualization_sales_count', 1, function () {
            $count = [];
            for ($i = 0; $i < 7; $i++) {
                $start = date('Y-m-d H:i:s', strtotime("+" . $i . " day", $this->week_start));
                $end = date('Y-m-d H:i:s', strtotime("+" . ($i + 1) . " day", $this->week_start));

                //待支付
                $count['create'][] = Order::whereBetween('created_at', [$start, $end])->where('status', 1)->count();

                $count['pay'][] = Order::whereBetween('pay_time', [$start, $end])->where('status', 2)->count();

                $count['picking'][] = Order::whereBetween('picking_time', [$start, $end])->where('status', 3)->count();

                $count['shipping'][] = Order::whereBetween('shipping_time', [$start, $end])->where('status', 4)->count();

                $count['finish'][] = Order::whereBetween('finish_time', [$start, $end])->where('status', 5)->count();
            }

            $data = [
                'week_start' => date("Y年m月d日", $this->week_start),
                'week_end' => date("Y年m月d日", $this->week_end),
                'count' => $count,
            ];

            return $data;
        });

    }

    /**
     * 本月热门销量
     */
    function top()
    {
        return Cache::remember('xApi_visualization_top', 1, function () {
            DB::enableQueryLog();
            $start = date("Y-m-d H:i:s", $this->month_start);
            $end = date("Y-m-d H:i:s", $this->month_end);

            //本月订单的id
            $order = Order::whereBetween('created_at', [$start, $end])->lists('id');

            //对应热门商品,前10名. 语句较复杂,请自己return sql出来看
            $products = OrderProduct::with('product')
                ->select('product_id', DB::raw('sum(num) as sum_num'))
                ->whereIn('order_id', $order)
                ->groupBy('product_id')
                ->orderBy(DB::raw('sum(num)'), 'desc')
                ->take(5)
                ->get();

            //return DB::getQueryLog();

            $data = [
                'month_start' => date("Y年m月d日", $this->month_start),
                'month_end' => date("Y年m月d日", $this->month_end),
                'products' => $products,
            ];

            return $data;
        });

    }

    /**
     * 本月每个地区的销量和金额
     */
    function sales_area()
    {
//          return Cache::remember('xApi_visualization_sales_area', 60, function () {

            $start = date("Y-m-d H:i:s", $this->month_start);
            $end = date("Y-m-d H:i:s", $this->month_end);

            //本月订单的id
            DB::enableQueryLog();
            $orders = Order::with('address')
                ->select('address_id', DB::raw('sum(total_price) as sum_num'))
                ->whereBetween('created_at', [$start, $end])
                ->groupBy('address_id')
                ->get();
            return DB::getQueryLog();

            $data = [
                'month_start' => date("Y年m月d日", $this->month_start),
                'month_end' => date("Y年m月d日", $this->month_end),
                'orders' => $orders,
            ];
//            return $data;
//        });
    }
}
