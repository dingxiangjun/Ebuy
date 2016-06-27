<?php
namespace App\Http\Controllers\Admin\xAd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;
use App\Model\xAd\Ad;
use App\Model\xAd\AdCategory as Category;

class AdController extends CommonController{

	public function __construct()
    {
        parent::__construct();
        view()->share([
            '_system' => 'xAd',
             'categories' => Category::get_categories(),
             '_ad' => 'am-active',
            '_title' => '广告管理--'
        ]);
    }

    public function index(Request $request)
    {

        //查找
        $where = function ($query) use ($request) {
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }
        };
    	$ads=Ad::with('category')->where($where)->orderBy('created_at', 'desc')->paginate(config('xSystem.page_size'));
        return view('Admin.xAd.ad.index')->with('ads',$ads);
    }
    //新增显示
    public function create(){
        return view('Admin.xAd.ad.create');
    }
    //新增数据
    public function store(Request $request){
        Ad::create($request->all());
        return redirect(route('admin.xAd.ad.index'))->with('success','新增成功');
        
    }
    //修改显示
    public function edit(){
        return view('Admin.xAd.ad.edit');
    }



}