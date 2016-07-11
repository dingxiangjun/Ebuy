@extends('Home.wechat.layout.application')

@section('content')
    <div class="page-list" data-log="商品列表">

        <ol class="version">
            @foreach ($products as $p)
                <li>
                    <a class="version-item" href="/home/wechat/product/{{$p->id}}">
                        <div class="version-item-img">
                            <img src="{{$p->thumb}}">
                        </div>
                        <div class="version-item-intro">
                            <div class="version-item-name"><p>{{$p->name}}</p></div>
                            <div class="version-item-intro-price"><span>{{doubleval($p->price)}}元</span></div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ol>
        @include('Home.wechat.layout._footer')
    </div>
@endsection