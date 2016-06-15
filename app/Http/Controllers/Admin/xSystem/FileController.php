<?php

namespace App\Http\Controllers\Admin\xSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

class FileController extends Controller
{
    //文件上传类
    public function upload(Request $request)
    {
        if ($request->hasFile('Filedata') and $request->file('Filedata')->isValid()) {

            $result = array();

            //文件类型
            $allow =array('image/jpeg', 'image/png', 'image/gif');
            $mine = $request->file('Filedata')->getMimeType();
            
            if (!in_array($mine, $allow)) {
                $result['status'] = 0;
                $result['info'] = '文件类型错误，只能上传图片';
                return $result;
            }

            //文件大小判断
            $max_size = 1024 * 1024 * 3;
            $size = $request->file('Filedata')->getClientSize();
            if ($size > $max_size) {
                $result['status'] = 0;
                $result['info'] = '文件大小不能超过3M';
                return $result;
            }

            //上传文件夹，如果不存在，建立文件夹
            $date = date("Y_m");
            $path = getcwd() . '/finder/images/' . $date;
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            //生成新文件名
            $extension = $request->file('Filedata')->getClientOriginalExtension();      //取得之前文件的扩展名

            $file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $extension;
            $request->file('Filedata')->move($path, $file_name);

            //返回新文件名
            $result['status'] = 1;
            $result['info'] = '/finder/images/' . $date . '/' . $file_name;
            return $result;
        }
    }

    //网站ico图标专用
    public function upload_icon(Request $request)
    {
        if ($request->hasFile('Filedata') and $request->file('Filedata')->isValid()) {

            $result = array();

            //取得之前文件的扩展名
            $extension = $request->file('Filedata')->getClientOriginalExtension();
            if ($extension != 'ico') {
                $result['status'] = 0;
                $result['info'] = '文件类型错误，只能上传ico格式的图片';
                return $result;
            }


            //文件大小判断
            $max_size = 1024 * 1024;
            $size = $request->file('Filedata')->getClientSize();
            if ($size > $max_size) {
                $result['status'] = 0;
                $result['info'] = '文件大小不能超过1M';
                return $result;
            }

            //上传文件夹，如果不存在，建立文件夹
            $path = getcwd();

            $file_name = "favicon.ico";
            $request->file('Filedata')->move($path, $file_name);
        }
    }
}
