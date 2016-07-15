@extends('Admin.layouts.application')
@section('content')
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf">
                    <strong class="am-text-primary am-text-lg">表单</strong> /
                    <small>form</small>
                </div>
            </div>

            <hr>
            <form class="am-form" method="post" action="{{route('admin.xEbuy.attribute.store')}}">
                {!! csrf_field() !!}
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        所属类型
                    </div>
                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                            <select data-am-selected="{btnWidth: '100%',  btnStyle: 'secondary', btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                                    name="product_categories_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id}}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                </div>

                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        属性名称
                    </div>
                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                        <input type="text" name="attr_name" class="am-input-sm">
                    </div>
                    <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        属性可选值
                    </div>
                    <div class="am-u-sm-8 am-u-md-4">
                        <textarea rows="6" name="attr_option_values" placeholder="请使用富文本编辑插件"></textarea>
                    </div>
                    <div class="am-hide-sm-only am-u-md-6"></div>
                </div>

                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        属性类型
                    </div>
                    <div class="am-u-sm-8 am-u-md-4">
                        <label class="am-radio-inline">
                            <input type="radio" value="0" name="attr_type" checked=""> 唯一
                        </label>
                        <label class="am-radio-inline">
                            <input type="radio" value="1" name="attr_type"> 可选
                        </label>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6"></div>
                </div>
                <div class="am-margin">
                    <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                    <a href="javascript:history.go(-1);" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
                </div>
            </form>
        </div>

        <footer class="admin-content-footer">
            <hr>
            <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
        </footer>
    </div>
@endsection

@section('js')
    <script src="/common/js/jquery.html5-fileupload.js"></script>
    <script src="/common/js/upload.js"></script>
    <script src="/common/ckfinder/ckfinder.js"></script>
    <script src="/common/js/ck_upload.js"></script>
@endsection
