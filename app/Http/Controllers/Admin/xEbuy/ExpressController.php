<?php

namespace App\Http\Controllers\Admin\xEbuy;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Controller;
use App\Model\xEbuy\Express;

class ExpressController extends CommonController
{
	public function __construct()
    {
        parent::__construct();
        view()->share([
            '_system' => 'xEbuy',
            '_xEbuy' => 'am-in',
            '_express' => 'am-active',
        ]);
    }
    
    function index(){
        
        $expresses=Express::orderBy('sort_order')->paginate(config('xSystem.page_size'));
    	return view("Admin.xEbuy.express.index",['expresses'=>$expresses]);
    }

    function sort_order(Request $request)
    {
        $express = Express::find($request->id);
        $express->sort_order = $request->sort_order;
        $express->save();
    }

    public function edit($id){
        $express = Express::find($id);
        return view('Admin.xEbuy.express.edit')->with('express', $express);
    }

    public function update(Request $request, $id)
    {
       
        $express = Express::find($id);
        $express->update($request->all());
        return redirect(route('admin.xEbuy.express.index'))->with('info', '修改物流信息成功');
    }

    function is_something(Request $request)
    {
        $attr = $request->attr;
        $express = Express::find($request->id);
        $value = $express->$attr ? false : true;
        $express->$attr = $value;
        $express->save();
    }

    
    
    function create(){
        return view("Admin.xEbuy.express.create");
    }
    
    function store(Request $request){
        Express::create($request->all());
        return redirect('/admin/xEbuy/express')->with('info', '添加成功');
    }   
}
