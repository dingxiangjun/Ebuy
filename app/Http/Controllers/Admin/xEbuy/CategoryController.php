<?php

namespace App\Http\Controllers\Admin\xEbuy;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Controller;
use App\Model\xEbuy\ProductCategory as Category;

class CategoryController extends CommonController
{
	public function __construct()
    {
        parent::__construct();
        view()->share([
            '_system' => 'xEbuy',
            'categories' => Category::get_categories(),
            '_xShop_product' => 'am-in',
            '_product_category' => 'am-active',
            '_title' => '商品分类-'
        ]);
    }
    
    function index(){
        
    	return view("Admin.xEbuy.category.index");
    }

    function create(){

    	return view('Admin.xEbuy.category.create');

    }

    function store(Request $request){
    	Category::create($request->all());
        Category::clear();
        return redirect('/admin/xEbuy/category')->with('success', '添加成功');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('Admin.xEbuy.category.edit')->with('category', $category);
    }

    function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        Category::clear();
        return redirect(route('admin.xEbuy.category.index'))->with('info', '编辑成功');
    }

    function is_something(Request $request)
    {
        
        $attr = $request->attr;
        $category = Category::find($request->id);
        $value = $category->$attr ? false : true;
        $category->$attr = $value;
        $category->save();
        Category::clear();
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
        if (!Category::check_children($id)) {
            return back()->with('error', '当前分类有子分类，请先将子分类删除后再尝试删除~');
        }

        if (!Category::check_products($id)) {
            return back()->with('error', '当前分类有商品，请先将对应商品删除后再尝试删除~');
        }

        Category::destroy($id);
        Category::clear();
        return back()->with('success', '删除成功');
    }


}
