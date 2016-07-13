<?php
Route::group(['prefix' => 'home/wechat', 'namespace' => 'Home\Wechat'], function () {
    
	    Route::get('/', 'IndexController@index');

	    //搜索
	    Route::get('/search', 'ProductController@search');

	    Route::group(['prefix' => 'product'], function (){

	    	//商品分类
	        Route::get('category', 'ProductController@category');
	    	//商品详情
	    	Route::get('{id}', 'ProductController@show');
	    	//商品列表
	        Route::get('/', 'ProductController@index');

	    });
	    Route::group(['prefix' => 'cart'], function (){
	    	 
	    	 //购物车
	    	 Route::post('/', 'CartController@store');
	         Route::get('/', 'CartController@index');
	         Route::patch('/', 'CartController@change_num');
	         Route::delete('/', 'CartController@destroy');


	    });

	    //订单
	    Route::group(['prefix' => 'order'], function () {
	        //下单
	        Route::get('checkout', 'OrderController@checkout');
	    });

	    //地址管理
        Route::group(['prefix' => 'address'], function () {
            //管理地址
            Route::get('/manage', 'AddressController@manage');
            //改变默认地址
            Route::patch('/', 'AddressController@default_address');
        });
        
        Route::resource('address', 'AddressController');


});