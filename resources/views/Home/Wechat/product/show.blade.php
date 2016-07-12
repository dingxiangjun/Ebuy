@extends('Home.wechat.layout.application')

@section('content')
    <div class="page-product-view" data-log="商品详情">

        <div class="header">
            <div class="left">
                <a onclick="location.href='/home/wechat'" class="icon icon-home"></a>
            </div>

            <div class="tit"></div>
            <div class="right">
                <a href="/home/wechat/search" >
                    <div class="icon icon-search"></div>
                </a>
            </div>
        </div>

        <div class="product-view">
            <div class="b1">
                <img src="{{$product->thumb}}">
            </div>
            <div class="b2">
                <div class="b21">
                    <div class="b211">
                        <div class="name"><p>{{$product->name}}</p></div>
                        <div class="price"><strong>{{doubleval($product->price)}}元</strong></div>
                    </div>
                    <div class="b212">
                        <div class="icon-fenxiang"></div>
                    </div>
                </div>
                <div class="b22">
                    <p>{{$product->desc}}</p>
                </div>
            </div>
            <div class="mt20" style="display: none;"></div>

            <!--<ul class="b3">-->
            <!--<li><span class="on">白色</span></li>-->
            <!--</ul>-->

            <ul class="b3" style="display: none;">
                <li><span>通用</span></li>
            </ul>

            <div class="ui-b7">
                <h3>为您推荐</h3>
                <div class="ui-carousel-container">
                    <div class="ui-carousel-viewport">
                        @foreach($recommends as $p)
                        <a href="/home/wechat/product/{{$p->id}}">
                            <img src="{{$p->thumb}}">
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="b5">
                <div class="b51"></div>
                <div class="b52">
                    <div class="blc">
                        {!! $product->content!!}

                    </div>
                </div>
            </div>
            <div class="b7">
                <div class="b70">
                    <a href="/home/wechat/">
                        <div class="icon-home"></div>
                    </a>
                </div>
                <div class="b72">
                    @if($product->stock == 0)
                        <a href="javascript:;" class="off">暂时缺货</a>
                    @else
                        <a href="javascript:;" id="add_to_cart">立即购买</a>
                    @endif
                </div>

                <div class="b73">
                    <a href="/home/wechat/cart">
                        <div class="icon-gouwuche"></div>
                    </a>
                </div>
            </div>
            <a href="javascript:;" id="top" style="visibility: hidden;">
                <img src="/common/wechat/images/top.png">
            </a>
        </div>
        <div class="share-component"></div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $("#add_to_cart").click(function () {
                $.ajax({
                    type: 'post',
                    url: '/home/wechat/cart',
                    data: {product_id: "{{$product->id}}"},
                    success: function (data) {
                        console.log(data);
                        location.href = '/home/wechat/cart';
                    }
                })
            })
        })
    </script>
@endsection