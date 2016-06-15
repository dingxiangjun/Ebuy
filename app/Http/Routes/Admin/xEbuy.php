<?php
/**
 * xEbuy 商城系统
 */
Route::group(['prefix' => 'admin/xEbuy', 'namespace' => 'Admin\xEbuy'], function () {
    Route::get('/', 'IndexController@index');
    //商品品牌
    Route::group(['prefix' => 'brand'], function () {
        Route::patch('sort_order', 'BrandController@sort_order');
        Route::patch('is_something', 'BrandController@is_something');
    });
    Route::resource('brand', 'BrandController');

    //商品分类
    Route::group(['prefix' => 'category'], function () {
        Route::patch('sort_order', 'CategoryController@sort_order');
        Route::patch('is_something', 'CategoryController@is_something');
    });
    Route::resource('category', 'CategoryController');

    //商品管理
    Route::group(['prefix' => 'product'], function () {
        Route::patch('change_stock', 'ProductController@change_stock');
        Route::delete('destroy_checked', 'ProductController@destroy_checked');
        Route::delete('destroy_gallery', 'ProductController@destroy_gallery');
        Route::patch('is_something', 'ProductController@is_something');
    });
    Route::resource('product', 'ProductController');
    

});
