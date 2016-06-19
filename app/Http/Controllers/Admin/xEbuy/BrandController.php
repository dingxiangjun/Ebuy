<?php

namespace App\Http\Controllers\Admin\xEbuy;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\xEbuy\Brand;
class BrandController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        view()->share([
            '_system' => 'xEbuy',
            '_xShop_product' => 'am-in',
            '_brand' => 'am-active',
            '_title' => '商品品牌-'
        ]);
    }


    public function index(Request $request)
    {

        $where = function ($query) use ($request) {
            if ($request->has('keyword') && $request->keyword != '') {
                $search = "%" . $request->keyword . "%";
                $query->where('name', 'like', $search);
            }
        };

        $brands = Brand::with('products')->where($where)->orderBy('sort_order')->paginate(5);
        return view('Admin.xEbuy.brand.index')->with('brands', $brands);
    }

    public function create()
    {
        return view('Admin.xEbuy.brand.create');

    }

    public function store(Request $request)
    {
        Brand::create($request->all());
        return redirect('/admin/xEbuy/brand')->with('success', '添加成功');
    }

    public function destroy($id)
    {
        if (!Brand::check_products($id)) {
            return back()->with('error', '当前品牌下有商品，请先将对应商品删除后再尝试删除~');
        }
        Brand::destroy($id);
        return redirect('/admin/xEbuy/brand')->with('error', '删除成功');
    }

    public function edit($id)
    {
        $brands = Brand::find($id);
        return view('Admin.xEbuy.brand.edit')->with('brand', $brands);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $brand->update($request->all());

        return redirect('/admin/xEbuy/brand')->with('info', '修改成功');
    }

    public function sort_order(Request $request)
    {

        $brand = Brand::find($request->id);
        $brand->sort_order = $request->sort_order;
        $brand->save();
    }

    public function is_something(Request $request)
    {
        
        $attr = $request->attr;
        $brand = Brand::find($request->id);
        $value = $brand->$attr ? false : true;
        $brand-> $attr=$value;
        $brand->save();

    }

    function upload(){
        return 111;
    }
}
