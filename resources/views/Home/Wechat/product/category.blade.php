@extends('Home.wechat.layout.application')

@section('content')
    <div class="page-category" data-log="商品分类">

        <div class="page-category-wrap">

            @foreach ($categories as $category)
                <div class="list-wrap" id="m0">
                    <h3 class="list_title">{{$category->name}}</h3>
                    <ol class="list_category">
                        @foreach($category->children as $c)
                            <li onclick="location.href='/home/wechat/product?category_id={{$c->id}}'">
                                <div class="img"><img src="{{$c->thumb}}"></div>
                                <div class="name"><span>{{$c->name}}</span></div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            @endforeach
        </div>
        @include('Home.wechat.layout._footer')
    </div>
    </div>
@endsection