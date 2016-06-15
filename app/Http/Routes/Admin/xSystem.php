<?php
/**
 * xEbuy 商城系统
 */
Route::group(['prefix' => 'admin/xSystem', 'namespace' => 'Admin\xSystem'], function () {

    //商品品牌，除去show方法
	Route::post('/upload', 'FileController@upload');
   
});
