<?php
/**
 * xEbuy 商城系统
 */
Route::group(['prefix' => 'admin/xAd', 'namespace' => 'Admin\xAd'], function () {
    
    Route::get('/', 'IndexController@index');
    
    //商品分类
    Route::resource('category', 'CategoryController');

    //商品列表
    Route::resource('ad', 'AdController');

});
