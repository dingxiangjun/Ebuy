<?php
Route::group(['prefix' => 'home/wechat', 'namespace' => 'Home\Wechat'], function () {
    
    Route::get('/', 'IndexController@index');

});