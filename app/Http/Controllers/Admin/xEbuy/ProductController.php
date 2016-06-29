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

    public function index(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {
            if ($request->has('name') and $request->name != '') {
                $search = "%" . $request->name . "%";
                $query->where('name', 'like', $search);
            }

            if ($request->has('category_id') and $request->category_id != '-1') {
                $query->where('category_id', $request->category_id);
            }

            if ($request->has('brand_id') and $request->brand_id != '-1') {
                $query->where('brand_id', $request->brand_id);
            }

            if ($request->has('is_onsale') and $request->is_onsale != '-1') {
                $query->where('is_onsale', $request->is_onsale);
            }

            if ($request->has('is_recommend')) {
                $query->where('is_recommend', true);
            }
            if ($request->has('is_hot')) {
                $query->where('is_hot', true);
            }
            if ($request->has('is_new')) {
                $query->where('is_new', true);
            }

            if ($request->has('created_at') and $request->created_at != '') {
                $time = explode(" ~ ", $request->input('created_at'));
                foreach ($time as $k => $v) {
                    $time["$k"] = $k == 0 ? $v . " 00:00:00" : $v . " 23:59:59";
                }
                $query->whereBetween('created_at', $time);
            }
        };

        $products = Product::with(['category','brand'])
            ->where($where)
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

        //相册
        if ($request->has('imgs')) {
            foreach ($request->imgs as $img) {
                $product->product_galleries()->create(['img' => $img]);
            }
        }

        return redirect('/admin/xEbuy/product')->with('success', '添加成功');
        //return back()->with('success', '新增成功~');
    }

    function edit($id){
        $this->attributes();
        $product=Product::find($id);
        return view('Admin.xEbuy.product.edit')->with('product', $product);;
    }

    function update(Request $request,$id){
        $data = $request->except(['stock', 'brand_id','flie','imgs']);
        $data['stock'] = $request->stock == '无限' ? '-1' : $request->stock;
        $data['brand_id'] = $request->brand_id == '-1' ? '' : $request->brand_id;

       $product = Product::find($id);
       $product->update($data);

        //相册
        if ($request->has('imgs')) {
            foreach ($request->imgs as $img) {
                $product->product_galleries()->create(['img' => $img]);
            }
        }
        return redirect('/admin/xEbuy/product')->with('info', '修改成功');
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

    /**
     * 删除多选
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function destroy_checked(Request $request){
        $checked_id = $request->input("checked_id");
        Product::destroy($checked_id);
    }

    function trash(){
        $products=Product::with(['category','brand'])->onlyTrashed()->paginate(config('xSystem.page_size'));

        return view('Admin.xEbuy.product.trash', ['products' => $products, '_product_trash' => 'am-active', '_product' => '']);
    }

    public function restore($id){
       Product::withTrashed()->where('id', $id)->restore();
       return redirect('/admin/xEbuy/product')->with('info', '还原成功');
    }


    public function force_destroy($id){
        Product::withTrashed()->where('id', $id)->forceDelete();
        return redirect('/admin/xEbuy/product')->with('info', '删除成功');
    }

    public function force_destroy_checked(Request $request){
        $checked_id = $request->checked_id;
        Product::withTrashed()->whereIn('id', $checked_id)->forceDelete();
        return redirect('/admin/xEbuy/product')->with('info', '多选删除成功');
    }

    public function restore_checked(Request $request){
        $checked_id = $request->input("checked_id");
        Product::withTrashed()->whereIn('id', $checked_id)->restore();
    }

}
