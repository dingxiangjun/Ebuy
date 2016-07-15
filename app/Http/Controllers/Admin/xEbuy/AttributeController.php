<?php

namespace App\Http\Controllers\Admin\xEbuy;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;
use App\Model\xEbuy\ProductCategory as Category;
use App\Model\xEbuy\Attribute;

class AttributeController extends CommonController
{

	public function __construct()
    {
        parent::__construct();
        view()->share([
            '_system' => 'xEbuy',
            '_xShop_product' => 'am-in',
            '_product_category' => 'am-active',
            '_title' => '商品分类-'
        ]);
    }

    private function attributes()
    {
        view()->share([
            'categories' => Category::get_categories(),
        
        ]);
    }
    function index(Request $request){
        //return $request->all();
        //多条件查找
        $where = function ($query) use ($request) {
            if ($request->has('category_id') and $request->category_id != '-1') {
                $query->where('product_categories_id', $request->category_id);
            }

        };

        $attributes=Attribute::where($where)
                ->paginate(config('xSystem.page_size'));
        //return $attributes;
        return view('Admin.xEbuy.attribute.index')->with('attributes',$attributes);
    }
    function create(){
        $this->attributes();
        return view('Admin.xEbuy.attribute.create');
    }

    function store(Request $request){
        Attribute::create($request->all());
        return redirect('/admin/xEbuy/attribute')->with('success', '添加成功');
    }
  
  
}
