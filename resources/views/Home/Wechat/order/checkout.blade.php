@extends('Home.wechat.layout.application')

@section('content')
    <div class="page-order-checkout">
        <div class="page-order-checkout-wrap">
            <div class="b1 icon_arrow" onclick="location.href='/address'">
                @if($address)
                    <div class="b11"><p><span>{{$address->name}}</span><span>{{$address->tel}}</span></p></div>
                    <div class="b13">
                        <p id="address" data-id="{{$address->id or ''}}">
                            {{$address->province or ''}} {{$address->city or ''}} {{$address->area or ''}} {{$address->detail or ''}}
                        </p>
                    </div>
                @else
                    <div class="b11"><p><span>没有收货地址!</span></p></div>
                    <div class="b13">
                        <p id="address" data-id="{{$address->id or ''}}">
                            <span style="color:#FF5722;">亲, 请先填写一个收货地址~</span>
                        </p>
                    </div>
                @endif
            </div>
            <div class="ui_line"></div>
            <div class="b2">
                <ul>
                    {{--<li class="on"><a href="javascript:;" class="alipaywap">支付宝支付</a></li>--}}
                    <li class="on"><a href="javascript:;" class="wechatpay">微信支付</a></li>
                    {{--<li class=""><a href="javascript:;" class="">货到付款</a></li>--}}
                </ul>
            </div>
            <div class="ui_line"></div>
            <!--
            <div class="b3 icon_arrow">
                <dl>
                    <dt><span>电子发票</span><strong>发票类型</strong></dt>
                </dl>
            </div>
            <div class="b3 icon_arrow">
                <dl>
                    <dt><span>不限送货时间</span><strong>送货时间</strong></dt>
                </dl>
            </div>
            <div class="ui_line"></div>
            -->

            <div class="b8">
                @foreach ($carts as $cart)
                    <div class="b8w">
                        <div class="b81">
                            <div class="img"><img src="{{$cart->product->thumb}}">
                            </div>
                        </div>
                        <div class="b82">
                            <div class="name"><p>
                                    <span>{{$cart->product->name}}</span></p></div>
                        </div>
                        <div class="b83">
                            <div class="price">
                                @if($cart->num > 1)
                                    <span>{{doubleval($cart->product->price)}} x {{$cart->num}} = </span>
                                @endif
                                <strong>{{doubleval($cart->product->price)*$cart->num}}元</strong>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="ui_line"></div>

            <div class="b5">
                <div class="b51"><p><strong>商品价格：</strong><span>{{$count['total_price']}}元</span></p></div>
                <div class="b53"><p><strong>配送费用：</strong><span>0元</span></p></div>
            </div>
            <div class="b7">
                <div class="b71"><span>共{{$count['num']}}件 合计: </span><strong>{{$count['total_price']}}元</strong></div>
                <div class="b72"><a href="javascript:;" class="ui-button" id="pay"><span>去付款</span></a></div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $("#pay").click(function () {
                var address_id = $("#address").data('id');
                if (address_id == '') {
                    alert('请先填写一个送货地址~');
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: '/order',
                    data: {address_id: address_id},
                    success: function (data) {
//                        console.log(data);
                        if (data.status == '0') {
                            alert(data.info);
                        }

                        //微信支付
                        location.href='/order/pay/'+data.order_id;
                    }
                })
            })
        });
    </script>
@endsection