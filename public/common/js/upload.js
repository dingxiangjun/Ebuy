//文件上传
var opts = {
    url: "/admin/xSystem/upload",
    type: "POST",
    beforeSend: function () {
        $("#loading").attr("class", "am-icon-spinner am-icon-pulse");
    },
    success: function (result, status, xhr) {
        if(result.status == "0") {
            alert(result.info);
            return false;
        }
        $("input[name='thumb']").val(result.info);
        $("#img_show").attr('src', result.info);
        $("#loading").attr("class", "am-icon-cloud-upload");
    },
    error: function (result, status, errorThrown) {
        alert('文件上传失败');
    }
}

$('#thumb_upload').fileUpload(opts);


/*
 <div class="am-g am-margin-top">
 <div class="am-u-sm-4 am-u-md-2 am-text-right">
 缩略图
 </div>

 <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">

 <div class="am-form-group am-form-file">
 <button type="button" class="am-btn am-btn-success am-btn-sm">
 <i class="am-icon-cloud-upload" id="loading"></i> 选择要上传的缩略图
 </button>
 <input type="file" id="thumb_upload">
 <input type="hidden" name="thumb" value="{{$link->thumb}}">
 </div>

 <div>
 <img src="{{$link->thumb}}" id="img_show" style="max-height: 200px;">
 </div>
 </div>
 </div>
*/