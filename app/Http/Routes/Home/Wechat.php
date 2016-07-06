<?php
Route::group(['prefix' => 'home/wechat', 'namespace' => 'Home\Wechat'], function () {
    
    Route::get('/', 'IndexController@index');

    Route::group(['prefix' => 'product'], function (){
    	 //商品详情
    	 Route::get('{id}', 'ProductController@show');
    });
    Route::group(['prefix' => 'cart'], function (){
    	 
    	 //购物车
    	 Route::post('/', 'CartController@store');
         Route::get('/', 'CartController@index');
         Route::patch('/', 'CartController@change_num');
    });

});