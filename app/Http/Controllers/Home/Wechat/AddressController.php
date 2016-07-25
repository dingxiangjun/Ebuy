<?php

namespace App\Http\Controllers\Home\Wechat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CommonController;
use App\Model\xEbuy\Product;
use App\Model\xEbuy\Cart;
use App\Model\xEbuy\Address;
use App\Model\xEbuy\Customer;

class AddressController extends CommonController{
    
    public function index(){
        $addresses = Address::where('customer_id', $this->customer->id)->get();
        //return $addresses;
        return view('Home.wechat.address.index')->with('addresses', $addresses);
    }
    //设置用户的默认地址
    public function default_address(Request $request)
    {

        Customer::where('id', $this->customer->id)->update(['address_id' => $request->address_id]);
        //重新设置session
        $customer = session()->get('customer');
        $customer['address_id'] = $request->address_id;
        session()->put('customer', $customer);
    }

    public function create(){
    	return view('Home.Wechat.address.create');
    }

    function store(Request $request)
    {
        //return $request->all();
        $pca = explode(" ", $request->pca);

        Address::create([
            'customer_id' => $this->customer->id,
            'name' => $request->name,
            'province' => $pca[0],
            'city' => $pca[1],
            'area' => $pca[2],
            'tel' => $request->tel,
            'detail' => $request->detail,
        ]);
    }

    function edit($id)
    {
        $address = Address::find($id);
        return view('Home.Wechat.address.edit')->with('address', $address);
    }

    function update(Request $request, $id)
    {
        $pca = explode(" ", $request->pca);

        Address::where('id', $id)
            ->update([
                'name' => $request->name,
                'province' => $pca[0],
                'city' => $pca[1],
                'area' => $pca[2],
                'tel' => $request->tel,
                'detail' => $request->detail,
            ]);
    }

    function manage()
    {
        $addresses = Address::where('customer_id', $this->customer->id)->get();
        return view('Home.Wechat.address.manage')->with('addresses', $addresses);
    }

    function destroy($id)
    {
        Address::destroy($id);
        return back();
    }
};
