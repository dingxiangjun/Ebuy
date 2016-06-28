@extends('Admin.layouts.application')

@section('content')
  <div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>一些常用模块</small></div>
      </div>

      <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
        <li><a href="#" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br/>新增页面<br/>2300</a></li>
        <li><a href="#" class="am-text-warning"><span class="am-icon-btn am-icon-briefcase"></span><br/>成交订单<br/>308</a></li>
        <li><a href="#" class="am-text-danger"><span class="am-icon-btn am-icon-recycle"></span><br/>昨日访问<br/>80082</a></li>
        <li><a href="#" class="am-text-secondary"><span class="am-icon-btn am-icon-user-md"></span><br/>在线用户<br/>3000</a></li>
      </ul>
      <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>

      <div class="am-g">
        <div class="am-u-sm-12">
          <div id="sales_count" style="width: 100%;height:400px;"></div>
        </div>
      </div>

      <div class="am-g">

        <div class="am-u-sm-12">
          <div id="sales_amount" style="width: 100%;height:400px;"></div>
        </div>
      </div>
      <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>


      <div class="am-g">
        <div class="am-u-sm-12">
          <div id="top" style="width: 100%;height:600px;"></div>
        </div>

        {{--<div class="am-u-sm-6">--}}
        {{--<div id="sales_area" style="width: 100%;height:600px;"></div>--}}
        {{--</div>--}}
      </div>
    </div>

    <footer class="admin-content-footer">
      <hr>
      <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>
  </div>
@endsection
@section('js')

<script src="/common/echarts/echarts.min.js"></script>
<script src="/common/echarts/china.js"></script>
<script src="/common/echarts/macarons.js"></script>

<script src="/common/visualization/sales_count.js"></script>
<script src="/common/visualization/sales_amount.js"></script>
<script src="/common/visualization/top.js"></script>

@endsection

