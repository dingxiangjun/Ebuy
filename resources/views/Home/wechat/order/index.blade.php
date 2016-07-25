@extends('Home.wechat.layout.application')

@section('content')
    <div class="cart-index" id="more" @if (!$orders->isEmpty()) style="display: none;" @endif>
        <div style="height:1rem;"></div>

        <div class="cart-index-wrap">
            <div class="empt">
                <div class="b3">
                    <a href="/product/category" class="ui-button ui-button-disable">
                        <span>全部商品</span>
                    </a>
                    <a href="/" class="ui-button">
                        <span>精选商品</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-my-order" data-log="我的订单" @if ($orders->isEmpty()) style="display: none;" @endif>

        <div class="order_list">

            @foreach($orders as $order)
                <div class="ol-item" onclick="location.href='/order/{{$order->id}}'">
                    <div>
                        <div class="oi1">
                            <div class="oi11">
                                <div class="oi111"><p>
                                        <strong>订单日期：</strong><span>{{$order->created_at->format('Y/m/d H:i')}}</span>
                                    </p></div>
                                <div class="oi112"><p><strong>订单编号：</strong><span>{{$order->id}}</span></p></div>
                            </div>
                            <div class="oi12"><p>{{$order_status["$order->status"]}}</p></div>
                        </div>
                        <div class="oi2">
                            <ul>
                                @foreach($order->order_products as $order_product)
                                    <li>
                                        <div class="oi21">
                                            <div class="img"><img src="{{$order_product->product->thumb}}">
                                            </div>
                                        </div>
                                        <div class="oi22"><p>{{$order_product->product->name}}</p></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="oi3">
                            <p>
                                <span>共{{count($order->order_products)}}件商品</span>
                                <span>总金额：</span><strong>{{doubleval($order->total_price)}}元</strong>
                            </p>
                        </div>

                        @if($order->status=='1')
                            <div class="oi4">
                                <a href="/order/pay/{{$order->id}}" class="org">立即付款</a>
                                <a href="/order/{{$order->id}}" data-method="delete" data-token="{{csrf_token()}}">取消订单</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('Home.wechat.layout._footer')

@endsection