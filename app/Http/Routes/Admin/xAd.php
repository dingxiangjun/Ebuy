<?php
/**
 * xEbuy 商城系统
 */
Route::group(['prefix' => 'admin/xAd', 'namespace' => 'Admin\xAd'], function () {
    
    Route::get('/', 'IndexController@index');
    
    

});
