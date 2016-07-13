@extends('Home.wechat.layouts.application')

@section('content')
    <div class="page-address-list" data-log="地址列表">
        <div class="address-manage">
            <div class="ui-card">
                @foreach($addresses as $a)
                    <ul class="ui-card-item ui-list">
                        <li class="ui-list-item identity">
                            <a href="/address/{{$a->id}}" data-method="delete" data-token="{{csrf_token()}}" class="delete">删除</a>
                            <span class="consignee">{{$a->name}}</span>
                            <span>{{$a->tel}}</span>
                        </li>
                        <li class="ui-list-item edit" onclick="location.href='/address/{{$a->id}}/edit'">
                            <p>{{$a->province}} {{$a->city}} {{$a->area}}</p>
                            <p>{{$a->detail}}</p>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>

        <div class="add">
            <a href="/address/create" class="ui-button ui-button-active"><span>新建地址</span></a>
        </div>
        <div class="popup-risk-check"></div>
    </div>
@endsection
