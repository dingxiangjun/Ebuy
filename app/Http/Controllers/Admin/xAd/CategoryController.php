<?php
namespace App\Http\Controllers\Admin\xAd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;
use App\Model\xAd\AdCategory as Category;

class CategoryController extends CommonController
{

	public function __construct()
    {
        parent::__construct();
        view()->share([
            '_system' => 'xAd',
            'categories' => Category::get_categories(),
            '_ad_category'=>'am-active',

        ]);
    }

    function index(){
    	
        return view('Admin.xAd.category.index');
    }
    public function create()
    {
        return view('Admin.xAd.category.create');
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        Category::clear();
        return redirect(route('admin.xAd.category.index'))->with('success', '添加分类成功');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('Admin.xAd.category.edit')->with('category', $category);
    }

    function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        Category::clear();
        return redirect(route('admin.xAd.category.index'))->with('success', '编辑成功~');
    }

    function sort_order(Request $request)
    {
        
        $category = Category::find($request->id);
        $category->sort_order = $request->sort_order;
        $category->save();
        Category::clear();
    }

    function destroy($id)
    {
        if (!Category::check_ads($id)) {
            return back()->with('error', '当前分类有广告，请先将对应广告删除后再尝试删除~');
        }

        Category::destroy($id);
        Category::clear();
        return back()->with('success', '删除成功');
    }

  
}
