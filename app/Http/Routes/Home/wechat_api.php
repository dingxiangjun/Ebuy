<?php
//微信Api接口
Route::group(['namespace' => 'home\wechat'], function () {
    //Api接口
    Route::any('api', 'ApiController@serve');
});