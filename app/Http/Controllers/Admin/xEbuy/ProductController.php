<?php

namespace App\Http\Controllers\Admin\xEbuy;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Requests;
use App\Model\xEbuy\Product, App\Model\xEbuy\Brand;
use App\Model\xEbuy\ProductCategory as Category;

class ProductController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        view()->share([
            '_system' => 'xEbuy',
            '_xShop_product' => 'am-in',
            '_product' => 'am-active',
            '_title' => '商品列表-'
        ]);
    }

    private function attributes()
    {
        view()->share([
            'categories' => Category::get_categories(),
            'brands' => Brand::orderBy('sort_order')->get(),
            'filter_categories' => Category::filter_categories()
        ]);
    }

    public function index()
    {
        
        $products = Product::with(['category','brand'])
            ->orderBy('is_top', "desc")
            ->orderBy('created_at')
            ->paginate(config('xSystem.page_size'));

       $this->attributes();
        return view('Admin.xEbuy.product.index')->with('products', $products);
         
    }

    public function create(){
        $this->attributes();
        return view('Admin.xEbuy.product.create')->with(['_new_product' => 'am-active', '_product' => '']);
        
    }

    public function store(Request $request){
        $data = $request->except(['stock', 'brand_id', 'file', 'imgs']);
        $data['stock'] = $request->stock == '无限' ? '-1' : $request->stock;
        $data['brand_id'] = $request->brand_id == '-1' ? '' : $request->brand_id;
        $product = Product::create($data);  
        return redirect('/admin/xEbuy/product')->with('success', '添加成功');
        //return back()->with('success', '新增成功~');
    }

    function is_something(Request $request)
    {
        $attr = $request->attr;
        $product = Product::find($request->id);
        $value = $product->$attr ? false : true;
        $product->$attr = $value;
        $product->save();
    }

    function change_stock(Request $request){
        if($request->stock < -1){
            return redirect('/admin/xEbuy/product')->with('success', '库存不能小于-1');
        }
        $stock = $request->stock;   
        $product = Product::find($request->id);
        $product->stock=$stock;
        $product->save();
    }

    /**
     * 删除所选
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function destroy($id)
    {
        /*if (!Product::check_orders($id)) {
            return back()->with('error', '当前商品拥有对应的订单，无法删除~');
        }*/
        Product::destroy($id);
        return back()->with('success', '被删商品已进入回收站~');
    }

    function destroy_checked(Request $request){
        return $request->all();
    }

}
