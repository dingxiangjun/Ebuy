@extends('Home.wechat.layout.application')

@section('content')
    <div class="page-order-pay" data-log="在线支付">
        <div class="box box1">
            <div class="p1"><span class="icon-checked"></span><span>订单提交成功</span></div>
            {{--<div class="p2"><span>请在1小时57分43秒内完成支付，超时订单将关闭。</span></div>--}}
        </div>
        <div class="box box2">
            <div class="p">订单金额：{{$order->total_price + $order->express_money}}元 &nbsp;&nbsp; 订单编号：{{$order->id}}</div>
            <div class="p h_box">
                <div>收货信息：</div>
                <div class="flex_1">
                    {{$order->address->name}} {{$order->address->tel}}
                    <br>{{$order->address->province}} {{$order->address->city}} {{$order->address->area}} {{$order->address->detail}}
                </div>
            </div>
            {{--<div class="p">发票类型：个人电子发票 <p>发票抬头：个人</p></div>--}}
        </div>
        <div class="box box3">
            <div class="head"><span>请选择支付方式</span></div>
            <div class="list">
                <div class="item active">
                    <div data-log="A0-微信" class="inner">
                        <div class="p">微信</div>
                        <div class="p right">推荐使用微信支付</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box4">
            <div class="p p1">
                <p>本次需支付：<span class="hot">{{$order->total_price + $order->express_money}}元</span></p>
            </div>
        </div>
        <div class="box box5">
            <a href="javascript:;" data-log="bottom-bankgo" class="ui-button" id="pay"><span>立即支付</span></a>
        </div>
    </div>
@endsection

@section('js')
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
        $(function () {
            $("#pay").click(function () {
                if (typeof WeixinJSBridge === 'undefined') {
                    alert('请在微信在打开页面！');
                    return false;
                }
                WeixinJSBridge.invoke(
                        'getBrandWCPayRequest', {!! $json !!}, function (res) {
                            switch (res.err_msg) {
                                case 'get_brand_wcpay_request:cancel':
                                    alert('您取消了支付！');
                                    break;
                                case 'get_brand_wcpay_request:fail':
                                    alert('支付失败！（' + res.err_desc + '）');
                                    break;
                                case 'get_brand_wcpay_request:ok':
                                    alert('支付成功！');
                                    location.href = '/order';
                                    break;
                                default:
                                    alert(JSON.stringify(res));
                                    break;
                            }
                        });
            })
        })
    </script>
@endsection