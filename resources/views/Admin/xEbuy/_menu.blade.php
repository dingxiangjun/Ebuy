<li>
    <a href="/admin/xEbuy" class="{{$_index or ''}}"><span class="am-icon-home"></span> 首页</a>
</li>

{{--<li class="admin-parent">--}}
    {{--<a class="am-cf" data-am-collapse="{parent: '#menus', target: '#collapse-products'}">--}}
        {{--<span class="am-icon-shopping-bag"></span>--}}
        {{--商品管理 <span class="am-icon-angle-right am-fr am-margin-right"></span>--}}
    {{--</a>--}}
    {{--<ul class="am-list am-collapse admin-sidebar-sub"--}}
        {{--id="collapse-products">--}}

        <li>
            <a href="{{route('admin.xEbuy.product.index')}}" class="{{$_product or ''}}">
                <span class="am-icon-th-list"></span> 商品列表
                <span class="am-badge am-badge-secondary am-margin-right am-fr am-radius">
                    {{ \App\Model\xEbuy\Product::count() }}
                </span>

            </a>
        </li>

        <li>
            <a href="{{route('admin.xEbuy.product.create')}}" class="{{$_new_product or ''}}">
                <span class="am-icon-cart-plus"></span> 添加新商品
                <span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.xEbuy.category.index')}}" class="{{ $_product_category or '' }}">
                <span class="am-icon-th"></span> 商品分类
                <span class="am-badge am-badge-warning am-margin-right am-fr am-radius">
                    {{ \App\Model\xEbuy\ProductCategory::count() }}
                </span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.xEbuy.brand.index') }}" class="{{ $_brand or '' }}">
                <span class="am-icon-apple"></span> 商品品牌
                <span class="am-badge am-badge-success am-margin-right am-fr am-radius">{{ \App\Model\xEbuy\Brand::count() }}</span>
            </a>
        </li>

        <li>
            <a href="/admin/xEbuy/product/trash" class="">
                <span class="am-icon-trash-o"></span> 商品回收站
                <span class="am-badge am-badge-danger am-margin-right am-fr am-radius"></span>
            </a>
        </li>
    {{--</ul>--}}
{{--</li>--}}

<li class="admin-parent">
    <a class="am-cf" data-am-collapse="{parent: '#menus', target: '#collapse-shop'}">
        <span class="am-icon-bank"></span>
        商店管理 <span class="am-icon-angle-right am-fr am-margin-right"></span>
    </a>
    <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-shop">
        <li>
            <a href="/admin/xEbuy/wechat" class="am-cf">
                <span class="am-icon-list-ol"></span> 微信自定义菜单
            </a>
        </li>
        <li>
            <a href="" class="">
                <span class="am-icon-list-alt"></span> 订单管理
                <span class="am-badge am-badge-secondary am-margin-right am-fr am-radius"></span>
            </a>
        </li>

        <li>
            <a href="" class="">
                <span class="am-icon-user"></span> 会员管理</span>
            </a>
        </li>

        <li>
            <a href="" class="">
                <span class="am-icon-plane"></span> 快递运费
                <span class="am-badge am-badge-warning am-margin-right am-fr am-radius"></span>
            </a>
        </li>
    </ul>
</li>

