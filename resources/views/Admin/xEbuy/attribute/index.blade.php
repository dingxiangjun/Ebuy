@extends('Admin.layouts.application')

@section('content')
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">属性列表管理</strong> /
                    <small>Good Categories Manage</small>
                </div>
            </div>

            <hr>

            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{route('admin.xEbuy.attribute.create')}}" class="am-btn am-btn-default"><span
                                        class="am-icon-plus"></span> 新增
                            </a>
                        </div>
                    </div>
                </div>
            
            </div>
            @include('Admin.layouts._flash')
            <div class="am-g">
                <div class="am-u-sm-12">
                    <form class="am-form">

                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                
                                <th class="table-id">编号</th>
                                <th class="table-title">属性名称</th>
                                <th class="table-type">属性类型</th>
                                <th class="table-author am-hide-sm-only">属性可选值</th>
                                <th class="table-set">所属类型ID</th>
        
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                              @foreach ($attributes as $attribute)
                            <tr class="xParent">
                                <td>{{$attribute->id}}</td>
                                <td>
                                    {{$attribute->attr_name}}
                                </td>
                                <td>
                                     @if($attribute->attr_type == 1)
                                        可选
                                     @elseif($attribute->attr_type == 0)
                                        唯一       
                                     @endif
                                </td>

                                <td>
                                    {{$attribute->attr_option_values}}
                                </td>

                                <td class="am-hide-sm-only">
                                    {{$attribute->product_category_id}}
                                </td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                           <a class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                               href="{{route('admin.xEbuy.attribute.edit', $attribute->id)}}">
                                                <span class="am-icon-pencil-square-o"></span> 编辑
                                            </a>

                                            <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                               href="{{route('admin.xEbuy.attribute.destroy', $attribute->id)}}"
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
    <script>
        $(function () {
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
                    url: "/admin/xEbuy/category/is_something",
                    data: data,
                    success: function () {
                       _this.toggleClass('am-icon-close am-icon-check');
                    }
                });
            });


        });

    </script>

@endsection





