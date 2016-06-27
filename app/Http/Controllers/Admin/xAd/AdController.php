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

    	$ads=Ad::with('category')
            ->where($where)
            ->orderBy('sort_order')
            ->paginate(config('xSystem.page_size'));

        return view('Admin.xAd.ad.index')->with('ads',$ads);
    }

    //新增显示
    public function create(){
        return view('Admin.xAd.ad.create')->with(['_new_ad' => 'am-active', '_ad' => '']);
    }

    //新增数据
    public function store(Request $request){
        Ad::create($request->all());
        return redirect(route('admin.xAd.ad.index'))->with('success','新增成功');
        
    }

    //修改显示
    public function edit($id){
        $ad=Ad::find($id);
        return view('Admin.xAd.ad.edit')->with('ad',$ad);
    }

    //修改数据
    public function update(Request $request,$id){
        $ad = Ad::find($id);
        $ad->update($request->all());
        Category::clear();
        return redirect(route('admin.xAd.ad.index'))->with('success','新增成功');
    }

    //删除
    function destroy($id)
    {
        Ad::destroy($id);
        return back()->with('success', '被删文章已进入回收站~');
    }

    //排序
    function sort_order(Request $request)
    {
        $ad = Ad::find($request->id);
        $ad->sort_order = $request->sort_order;
        $ad->save();
    }

    /**
     * 商品回收站
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        $ads = Ad::with('category')->onlyTrashed()->paginate(config('xSystem.page_size'));
        return view('Admin.xAd.ad.trash', ['ads' => $ads, '_ad_trash' => 'am-active', '_ad' => '']);
    }

    /*
     * 还原文章
     */
    public function restore($id)
    {
        Ad::withTrashed()->where('id', $id)->restore();
        return back()->with('info', '还原成功');

    }

    public function restore_checked(Request $request)
    {
        $checked_id = $request->input("checked_id");
        Ad::withTrashed()->whereIn('id', $checked_id)->restore();
        return back()->with('info', '还原成功');

    }

    public function force_destroy($id)
    {
        Ad::withTrashed()->where('id', $id)->forceDelete();
        return back()->with('info', '删除成功');
    }

    /**
     * 多选删除
     * @param Request $request
     */
    function destroy_checked(Request $request)
    {
        $checked_id = $request->input("checked_id");
        Ad::destroy($checked_id);
    }

    function force_destroy_checked(Request $request)
    {
        $checked_id = $request->input("checked_id");
        Ad::withTrashed()->whereIn('id', $checked_id)->forceDelete();
    }
}