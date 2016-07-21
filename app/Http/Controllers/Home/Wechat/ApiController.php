<?php

namespace App\Http\Controllers\Home\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use EasyWeChat\Message\Text;
use EasyWeChat\Message\News;

use App\Model\xEbuy\Product, App\Model\xEbuy\Order, App\Model\xEbuy\Customer;
use EasyWeChat;


class ApiController extends Controller
{

    public function serve()
    {
        //return 11;
        // 从项目实例中得到服务端应用实例。
        $server = EasyWeChat::server();

        $server->setMessageHandler(function ($message) {

            //事件处理
            if ($message->MsgType == 'event') {
                switch ($message->Event) {
                    //关注事件
                    case 'subscribe':
                        return new Text(['content' => '欢迎关注 武汉长乐PHP教育! 亲, 还在等什么, 赶紧去长乐小卖部买东西啊~']);
                        break;

                    //点击事件
                    case 'CLICK':
                        switch ($message->EventKey) {
                            case 'recommend':
                                return $this->is_recommend();
                                break;

                            case 'new':
                                return $this->is_new();
                                break;

                            case 'hot':
                                return $this->is_hot();
                                break;

                            case 'order':
                                return $this->order($message->FromUserName);
                                break;

                            case 'joke':
                                return $this->joke();
                                break;

                            case 'weather':
                                return $this->weather();
                                break;
                        }
                        break;
                }
            }

            //文本消息
            if ($message->MsgType == 'text') {
                switch ($message->Content) {
                    case '精选':
                    case '推荐':
                    case '精选推荐':
                    case 'recommend':
                        return $this->is_recommend();
                        break;

                    case '新品':
                    case '新品到货':
                    case 'new':
                        return $this->is_new();
                        break;

                    case '人气':
                    case '热卖':
                    case '人气热卖':
                    case 'hot':
                        return $this->is_hot();
                        break;

                    case '我的订单':
                    case '订单':
                    case 'order':
                        return $this->order($message->FromUserName);
                        break;

                    case '笑话':
                    case '讲个笑话':
                        return $this->joke();
                        break;

                    case '天气':
                    case '天气预报':
                        return $this->weather();
                        break;

                    default:
                        return $this->default_msg();
                }
            }

            //语音消息
            if ($message->MsgType == 'voice') {
                switch ($message->Recognition) {
                    case '精选！':
                    case '推荐！':
                    case '精选推荐！':
                        return $this->is_recommend();
                        break;

                    case '新品！':
                    case '新品到货！':
                        return $this->is_new();
                        break;

                    case '人气！':
                    case '热卖！':
                    case '人气热卖！':
                        return $this->is_hot();
                        break;

                    case '订单！':
                    case '我的订单！':
                        return $this->order($message->FromUserName);
                        break;

                    case '笑话！':
                    case '讲个笑话！':
                        return $this->joke();
                        break;

                    case '天气！':
                    case '天气预报！':
                        return $this->weather();
                        break;

                    default:
                        return '您说的是:' . $message->Recognition . '?';
                }
            }

        });

        return $server->serve();
    }

    //讲个笑话
    private function joke()
    {
        $rand = rand(1, 20000);
        $url = "http://api.1-blog.com/biz/bizserver/xiaohua/list.do?size=1&page=" . $rand;

        $joke = file_get_contents($url);

        $joke = json_decode($joke, true);
        return $joke['detail'][0]['content'];
    }

    //天气预报
    private function weather()
    {
        $url = "http://api.1-blog.com/biz/bizserver/weather/list.do?city=武汉";

        $weather = file_get_contents($url);
        $weather = json_decode($weather, true);
        return '今天武汉的天气:' . $weather['detail'][0]['day_condition'] . ' 温度: ' . $weather['detail'][0]['night_temperature'] . '~' . $weather['detail'][0]['day_temperature'];
    }

    //精选推荐
    private function is_recommend()
    {
        $products = Product::where('is_recommend', true)
            ->orderBy('is_top', "desc")
            ->orderBy('created_at')
            ->take(6)
            ->get();

        $news = [];
        foreach ($products as $p) {
            $news[] = new News([
                'title' => $p->name,
                'description' => $p->desc,
                'url' => 'http://wechat.phpwh.com/product/' . $p->id,
                'image' => 'http://wechat.phpwh.com/' . $p->thumb,
            ]);
        }
        return $news;
    }


    //人气热卖
    private function is_hot()
    {
        $products = Product::where('is_hot', true)
            ->orderBy('is_top', "desc")
            ->orderBy('created_at')
            ->take(6)
            ->get();

        $news = [];
        foreach ($products as $p) {
            $news[] = new News([
                'title' => $p->name,
                'description' => $p->desc,
                'url' => 'http://wechat.phpwh.com/product/' . $p->id,
                'image' => 'http://wechat.phpwh.com/' . $p->thumb,
            ]);
        }
        return $news;
    }

    //新品到货
    private function is_new()
    {
        $products = Product::where('is_new', true)
            ->orderBy('is_top', "desc")
            ->orderBy('created_at')
            ->take(6)
            ->get();

        $news = [];
        foreach ($products as $p) {
            $news[] = new News([
                'title' => $p->name,
                'description' => $p->desc,
                'url' => 'http://wechat.phpwh.com/product/' . $p->id,
                'image' => 'http://wechat.phpwh.com/' . $p->thumb,
            ]);
        }
        return $news;
    }

    function order($openid)
    {
        $customer = Customer::where('openid', $openid)->first();

        //如果用户还不存在,直接返回
        if (!$customer) {
            return '你没有未完成的订单, 马上去购物吧~';
        }

        $order_status = config('xSystem.order_status');
        $orders = Order::where('status', '<', 5)
            ->where('customer_id', $customer->id)
            ->with('order_products.product')
            ->orderBy('status')
            ->take(6)
            ->get();

        if ($orders->isEmpty()) {
            return '你没有未完成的订单, 马上去购物吧~';
        }

        $news = [];
        foreach ($orders as $order) {

            $news[] = new News([
                'title' => '订单号' . $order->id . " (" . $order_status[$order->status] . ")",
                'url' => 'http://wechat.phpwh.com/order/' . $order->id,
                'image' => 'http://wechat.phpwh.com/' . $order->order_products->first()->product->thumb,
            ]);
        }
        return $news;
    }

    function default_msg()
    {
        return '有趣的问题~';
    }
}