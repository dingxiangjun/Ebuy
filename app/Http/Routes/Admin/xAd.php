<?php
/**
 * xEbuy 商城系统
 */
Route::group(['prefix' => 'admin/xAd', 'namespace' => 'Admin\xAd'], function () {
    
    Route::get('/', 'IndexController@index');
    
    //商品分类
    Route::group(['prefix' => 'category'], function () {
        Route::patch('sort_order', 'CategoryController@sort_order');
        Route::delete('destroy_checked', 'CategoryController@destroy_checked');
        Route::patch('is_something', 'CategoryController@is_something');
    });
    Route::resource('category', 'CategoryController');

    //商品列表
    Route::group(['prefix' => 'ad'], function () {
        Route::patch('sort_order', 'AdController@sort_order');
        Route::delete('destroy_checked', 'AdController@destroy_checked');
        Route::patch('is_something', 'AdController@is_something');

        //回收站
        Route::get('trash', 'AdController@trash');
        Route::get('/{ad}/restore', 'AdController@restore');
        Route::delete('/{ad}/force_destroy', 'AdController@force_destroy');
        Route::delete('force_destroy_checked', 'AdController@force_destroy_checked');
        Route::post('restore_checked', 'AdController@restore_checked');
    });
    Route::resource('ad', 'AdController');

});
