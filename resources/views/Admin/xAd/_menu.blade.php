<li>
    <a href="/admin/xAd" class="{{$_index or ''}}"><span class="am-icon-home"></span> 首页</a>
</li>

{{--<li class="admin-parent">--}}
    {{--<a class="am-cf" data-am-collapse="{parent: '#menus', target: '#collapse-products'}">--}}
        {{--<span class="am-icon-shopping-bag"></span>--}}
        {{--广告列表 <span class="am-icon-angle-right am-fr am-margin-right"></span>--}}
    {{--</a>--}}
    {{--<ul class="am-list am-collapse admin-sidebar-sub"--}}
        {{--id="collapse-products">--}}
        <li>
            <a href="{{route('admin.xAd.ad.index')}}" class="{{$_ad or ''}}">
                <span class="am-icon-th-list"></span> 广告列表
                <span class="am-badge am-badge-secondary am-margin-right am-fr am-radius">
                   {{ \App\Model\xAd\Ad::count() }}
                </span>

            </a>
        </li>
        <li>
            <a href="{{route('admin.xAd.ad.create')}}" class="{{$_new_ad or ''}}">
                <span class="am-icon-th-list"></span> 添加新广告
            </a>
        </li>
        <li>
            <a href="{{route('admin.xAd.category.index')}}" class="{{$_ad_category or ''}}">
                <span class="am-icon-th"></span> 广告分类
                <span class="am-badge am-badge-warning am-margin-right am-fr am-radius">
                   {{ \App\Model\xAd\AdCategory::count() }}
                </span>
            </a>
        </li>

        <li>
            <a href="/admin/xAd/ad/trash" class="{{$_ad_trash or ''}}">
                <span class="am-icon-trash-o"></span> 广告回收站
                <span class="am-badge am-badge-danger am-margin-right am-fr am-radius">
                   {{ \App\Model\xAd\ad::onlyTrashed()->count() }}
                </span>
            </a>
        </li>
    {{--</ul>--}}
{{--</li>--}}

