@extends('Admin.layouts.application')
@section('css')
    <link rel="stylesheet" href="/common/daterangepicker/daterangepicker.css">
    <style>
        .thumb {
            max-height: 60px;
        }
    </style>
@endsection
@section('content')
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品列表</strong> /
                    <small>Product List</small>
                </div>
            </div>

            <hr>
            @include('Admin.layouts._flash')
            <div class="am-g" style="height: 37px;">
            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a type="button" class="am-btn am-btn-default" href="{{route('admin.xEbuy.product.create')}}">
                            <span class="am-icon-plus"></span> 新增
                        </a>
                        <button type="button" class="am-btn am-btn-default" id="destroy_checked">
                            <span class="am-icon-trash-o"></span> 删除
                        </button>
                    </div>
                </div>
            </div>
        </div>
            <div class="am-g">
            <div class="am-u-sm-12 am-u-md-12">
                <form class="am-form-inline" role="form" method="get">

                    <div class="am-form-group">
                        <input type="text" name="name" class="am-form-field am-input-sm" placeholder="商品名" value="{{ Request::input('name') }}">
                    </div>

                    <div class="am-form-group">
                        <select data-am-selected="{btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                                name="category_id">
                            <optgroup label="请选择">
                                <option value="-1">所有分类</option>
                            </optgroup>
                            @foreach($filter_categories as $category)
                                <optgroup label="{{$category->name}}">
                                 @foreach($category->children as $c)
                                    <option value="{{$c->id}}" @if($c->id == Request::input('category_id')) selected @endif>
                                            {{$c->name}}
                                    </option>

                                 @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div class="am-form-group">
                        {{ buildSelect($brands,'brand_id','id','name',Request::input('brand_id')) }}
                        {{--<select data-am-selected="{btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                                         name="brand_id">
                            <option value="-1">所有品牌</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}" @if($brand->id == Request::input('brand_id')) selected @endif>
                                    {{$brand->name}}
                                </option>
                            @endforeach
                        </select>--}}
                    </div>

                    <div class="am-form-group">
                        
                    </div>

                    <div class="am-form-group">
                        <div class="am-btn-group" data-am-button="">
                            <label class="am-btn am-btn-default am-btn-sm am-radius @if(Request::input('is_top') == 1) am-active @endif">
                                <input type="checkbox" name="is_top" value="1" @if(Request::input('is_top') == 1) checked @endif> 置顶
                            </label>
                            <label class="am-btn am-btn-default am-btn-sm am-radius @if(Request::input('is_recommend') == 1) am-active @endif">
                                <input type="checkbox" name="is_recommend" value="1" @if(Request::input('is_recommend') == 1) checked @endif> 推荐
                            </label>
                            <label class="am-btn am-btn-default am-btn-sm am-radius @if(Request::input('is_hot') == 1) am-active @endif">
                                <input type="checkbox" name="is_hot" value="1" @if(Request::input('is_hot') == 1) checked @endif> 热销
                            </label>
                            <label class="am-btn am-btn-default am-btn-sm am-radius @if(Request::input('is_new') == 1) am-active @endif">
                                <input type="checkbox" name="is_new" value="1" @if(Request::input('is_new') == 1) checked @endif> 新品
                            </label>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <select data-am-selected="{btnSize: 'sm'}" name="is_onsale" id="">
                            <option value="-1" @if(Request::input('is_onsale') == '-1') selected @endif>上架状态</option>
                            <option value="1" @if(Request::input('is_onsale') == '1') selected @endif>上架</option>
                            <option value="0" @if(Request::input('is_onsale') == '0') selected @endif>下架</option>
                        </select>
                    </div>

                    <div class="am-form-group">
                            <input type="text" id="created_at" placeholder="选择时间日期" name="created_at"
                                   value="{{ Request::input('created_at') }}" class="am-form-field am-input-sm"/>
                    </div>

                    <button type="submit" class="am-btn am-btn-default am-btn-sm">查询</button>
                </form>
            </div>

        </div>
            <div class="am-g">
                <div class="am-u-sm-12">
                    <form class="am-form">

                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                
                               <th class="table-check"><input type="checkbox" id="checked"/></th>
                            <th class="table-id">ID</th>
                            <th class="table-thumb">缩略图</th>
                            <th class="table-title">商品名称</th>
                            <th class="table-category">所属分类</th>
                            <th class="table-brand">品牌</th>
                            <th class="table-price">单价</th>
                            <th class="am-hide-sm-only">上架</th>
                            <th class="am-hide-sm-only">置顶</th>
                            <th class="am-hide-sm-only">推荐</th>
                            <th class="am-hide-sm-only">热销</th>
                            <th class="am-hide-sm-only">新品</th>
                            <th class="am-hide-sm-only" style="width:10%">库存</th>
                            <th class="table-date am-hide-sm-only">上架日期</th>

                            <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                            <tr data-id="{{$product->id}}">
                                <td><input type="checkbox" value="{{$product->id}}" class="checked_id"
                                           name="checked_id[]"/></td>
                                <td>{{$product->id}}</td>
                                <td>
                                    @if($product->thumb)<img width="100" height="50" src="{{$product->thumb}}" alt="" class="thumb">@endif
                                </td>
                                <td>
                                    {{$product->name}}
                                </td>

                                <td>{{$product->category->name}}</td>

                                <td>
                                    {{$product->brand->name or ''}}
                                </td>

                                <td>
                                    {{$product->price}}
                                </td>

                                @foreach (array('is_onsale', 'is_top', 'is_recommend', 'is_hot', 'is_new') as $attr)
                                    <td class="am-hide-sm-only">
                                        {!! is_something($attr, $product) !!}
                                    </td>
                                @endforeach


                                <td class="am-hide-sm-only">
                                    <input type="text" name="stock" class="am-input-sm" value="{{show_stock($product->stock)}}">
                                </td>

                                <td class="am-hide-sm-only">
                                    {{$product->created_at->format("Y-m-d H:i")}}
                                </td>

                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                               href="{{route('admin.xEbuy.product.edit', $product->id)}}">
                                                <span class="am-icon-pencil-square-o"></span> 编辑
                                            </a>

                                            <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                               href="{{route('admin.xEbuy.product.destroy', $product->id)}}"
                                               data-method="delete"
                                               data-token="{{csrf_token()}}" data-confirm="确认删除吗?">
                                                <span class="am-icon-trash-o"></span> 删除
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                        共 {{$products->total()}} 条记录

                    <div class="am-cf">
                        <div class="am-fr">
                            {!! $products->appends(Request::all())->links() !!}
                        </div>
                    </div>
                    <hr/>
                    </form>
                </div>

            </div>
        </div>

        <footer class="admin-content-footer">
            <hr>
            <p class="am-padding-left">? 2014 AllMobilize, Inc. Licensed under MIT license.</p>
        </footer>
        <span id="on" data-am-modal="{target: '#my-alert'}"></span>
    </div>
@endsection

@section('js')
    <script src="/common/daterangepicker/moment.js"></script>
    <script src="/common/moment/locale/zh-cn.js"></script>
    <script src="/common/daterangepicker/daterangepicker.js"></script>
    <script src="/common/js/daterange_config.js"></script>
    <script>
        $(function () {
             //库存
            $("input[name='stock']").change(function () {
                var stock = $(this).val() == '无限' ? '-1' : $(this).val();
                if (stock <-1) {
                    alert('库存不能小于-1');
                }
                var data = {
                    stock: stock,
                    id: $(this).parents("tr").data('id')
                }
                console.log(data);
                $.ajax({
                    type: "PATCH",
                    url: "/admin/xEbuy/product/change_stock",
                    data: data,
                });
            })


            //排序
            $("input[name='sort_order']").change(function () {
                var data = {
                    sort_order: $(this).val(),
                    id: $(this).parents("tr").data('id')
                };
                console.log(data);
                $.ajax({
                    type: "PATCH",
                    url: "/admin/xEbuy/category/sort_order",
                    data: data,
                });
            });


            //是否...
            $(".is_something").click(function () {
                var _this = $(this);
                var data = {
                    id: _this.parents("tr").data('id'),
                    attr: _this.data('attr')
                }
                console.log(data);
                $.ajax({
                    type: "PATCH",
                    url: "/admin/xEbuy/product/is_something",
                    data: data,
                    success: function () {
                       _this.toggleClass('am-icon-close am-icon-check');
                    }
                });
            });

    
            //删除所选
            $('#destroy_checked').click(function () {
                var length = $(".checked_id:checked").length;
                if (length == 0) {
                    alert("您必须至少选中一条!");
                    return false;
                }

                var checked_id = $(".checked_id:checked").serialize();

                $.ajax({
                    type: "DELETE",
                    url: "/admin/xEbuy/product/destroy_checked",
                    data: checked_id,
                    success: function () {
                        location.href = location.href;
                    }
                });
            });

        });

    </script>

@endsection





