@extends('Admin.layouts.application')

@section('content')
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品品牌</strong> /
                    <small>Good Brands</small>
                </div>
            </div>

            <hr>

            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{route('admin.xEbuy.brand.create')}}" class="am-btn am-btn-default"><span
                                        class="am-icon-plus"></span> 新增
                            </a>

                        </div>
                    </div>
                </div>
                <form method="get" action="">
                    <div class="am-u-sm-12 am-u-md-3">
                        <div class="am-input-group am-input-group-sm">
                            <input type="text" name="keyword" class="am-form-field"
                                   value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''?>">
                          <span class="am-input-group-btn">
                            <button class="am-btn am-btn-default" type="submit">搜索</button>
                          </span>
                        </div>
                    </div>
                </form>
            </div>
            @include('Admin.layouts._flash')
            <div class="am-g">
                <div class="am-u-sm-12">
                    <form class="am-form">

                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th class="table-check"><input type="checkbox" id="checked" /></th>
                                <th class="table-id">ID</th>
                                <th class="table-title">缩略图</th>
                                <th class="table-type">品牌名称</th>
                                <th class="table-author am-hide-sm-only">品牌商品</th>
                                <th class="table-date am-hide-sm-only">品牌描述</th>
                                <th class="table-set">是否显示</th>
                                <th class="table-set">排序</th>
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            @foreach($brands as $brand)
                                <tr data-id="{{$brand->id}}">
                                    <td><input type="checkbox" name="checked_id[]" class="checked_id" /></td>
                                    <td>{{$brand->id}}</td>
                                    <td><a href="#"><img width="70" height="60" src="{{$brand->thumb}}"/></a></td>
                                    <td>{{$brand->name}}</td>
                                    <td class="am-hide-sm-only">
                                        {!! show_brand_products($brand) !!}
                                    </td>
                                    <td class="am-hide-sm-only">{{$brand->desc}}</td>
                                    <td class="am-hide-sm-only">
                                        {!! is_something('is_show', $brand) !!}
                                    </td>
                                    <td class="am-hide-sm-only">
                                        <input  type="text" name="sort_order" class="am-input-sm sort"
                                               value="{{$brand->sort_order}}">
                                    </td>

                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{route('admin.xEbuy.brand.edit',$brand->id)}}"
                                                   class="am-btn am-btn-default am-btn-xs am-text-secondary"><span
                                                            class="am-icon-pencil-square-o"></span> 编辑
                                                </a>
                                                <a href="{{route('admin.xEbuy.brand.destroy',$brand->id)}}"
                                                   class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" data-method="delete" data-token="{{csrf_token()}}"><span
                                                            class="am-icon-trash-o"></span>删除
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <div class="am-cf">
                            当前页{!! $brands->currentPage()!!} &nbsp共 {!! $brands->total() !!}条记录
                            <div class="am-fr">
                                <ul class="am-pagination">
                                    {!! $brands->links() !!}
                                </ul>
                            </div>
                        </div>
                        <hr/>
                        <p>注：.....</p>
                    </form>
                </div>

            </div>
        </div>

        <footer class="admin-content-footer">
            <hr>
            <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
        </footer>
        <span id="on" data-am-modal="{target: '#my-alert'}"></span>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function () {
            $("input[name='sort_order']").change(function () {
                var data = {
                    sort_order: $(this).val(),
                    id: $(this).parents("tr").data('id')
                }
                console.log(data);
                $.ajax({
                    type: "PATCH",
                    url:"/admin/xEbuy/brand/sort_order",
                    data: data
                });
            })

            $('.is_something').click(function () {
                var _this=$(this);
                var data={
                    id: _this.parents("tr").data('id'),
                    attr: _this.data('attr')
                };
                console.log(data)
                $.ajax({
                    type: "PATCH",
                    url:"/admin/xEbuy/brand/is_something",
                    data: data,
                    success: function () {
                        _this.toggleClass('am-icon-close am-icon-check');
                    }
                });
            })

        })



    </script>

@endsection





