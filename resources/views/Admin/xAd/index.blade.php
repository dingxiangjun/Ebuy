@extends('Admin.layouts.application')

@section('content')
  <div class="admin-content">

    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">管理首页</strong> /
        <small>Manage Home</small>
      </div>
    </div>

    @include('Admin.layouts._flash')

    <ul class="am-avg-sm-1 am-avg-md-3 am-margin am-padding am-text-center admin-content-list ">
      <li>
        <a href="{{route('admin.xAd.ad.create')}}" class="am-text-danger">
          <span class="am-icon-btn am-icon-plus"></span><br/>添加新广告
        </a>
      </li>

      <li>
        <a href="{{route('admin.xAd.category.index')}}" class="am-text-warning">
          <span class="am-icon-btn am-icon-tv"></span><br/>广告分类<br/>{{ \App\Model\xAd\AdCategory::count() }}
        </a>
      </li>

      <li>
        <a href="{{ route('admin.xAd.ad.index') }}" class="am-text-success">
          <span class="am-icon-btn am-icon-picture-o"></span><br/>广告列表<br/>{{ \App\Model\xAd\Ad::count() }}
        </a>
      </li>
    </ul>
    </div>

    <footer class="admin-content-footer">
      <hr>
      <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>
  </div>
@endsection

