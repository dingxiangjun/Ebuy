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
            <form class="am-form" method="post" action="{{route('admin.xEbuy.category.store')}}">
                {!! csrf_field() !!}
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        上级分类
                    </div>
                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                            <select data-am-selected="{btnWidth: '100%',  btnStyle: 'secondary', btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                                    name="parent_id">
                                <option value="0">顶级分类</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                </div>

                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        分类名称
                    </div>
                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                        <input type="text" name="name" class="am-input-sm">
                    </div>
                    <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        缩略图
                    </div>
                    <div class="am-u-sm-8 am-u-md-8 am-u-end col-end">
                        <div class="am-form-group am-form-file new_thumb">
                            <button type="button" class="am-btn am-btn-secondary am-btn-sm">
                                <i class="am-icon-cloud-upload" id="loading"></i> 上传新的缩略图
                            </button>
                            <input type="file" id="thumb_upload" >
                        </div>
                        <div class="select_thumb">
                            <button type="button" class="am-btn am-btn-success am-btn-sm" id="ck_thumb_upload" style="margin-left: 5px;">
                                <i class="am-icon-search-plus" id="loading"></i> 选择已存在的缩略图
                            </button>
                            <input type="hidden" name="thumb">
                        </div>

                        <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

                        <div>
                            <img src="" id="img_show" style="max-height: 200px;">
                        </div>
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        描述信息
                    </div>
                    <div class="am-u-sm-8 am-u-md-4">
                        <textarea rows="6" name="desc" placeholder="请使用富文本编辑插件"></textarea>
                    </div>
                    <div class="am-hide-sm-only am-u-md-6"></div>
                </div>

                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                        显示在导航栏
                    </div>
                    <div class="am-u-sm-8 am-u-md-4">
                        <label class="am-radio-inline">
                            <input type="radio" value="1" name="is_show" checked=""> 是
                        </label>
                        <label class="am-radio-inline">
                            <input type="radio" value="0" name="is_show"> 否
                        </label>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6"></div>
                </div>

                <div class="am-g am-margin-top-sm">
                    <div class="am-u-sm-12 am-u-md-2 am-text-right admin-form-text">
                        排序
                    </div>
                    <div class="am-u-sm-12 am-u-md-10">
                    </div>
                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                        <input type="text" name="sort_order" class="am-input-sm" value="99">
                    </div>

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
