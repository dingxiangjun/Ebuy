<?php
//微信Api接口
Route::group(['namespace' => 'Home\Wechat'], function () {
    //Api接口
    Route::any('api', 'ApiController@serve');
});