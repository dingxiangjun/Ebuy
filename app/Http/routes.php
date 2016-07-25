<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
	//微信
    
   	//微信api
	require 'Routes/Home/wechat_api.php';

	
		
	/**********
     * 前端
     **********/
	require 'Routes/Home/wechat.php';


	
	Route::group(['domain' => 'ebuy.app'], function () {

    /**********
     * 后台
     **********/
		Route::group(['prefix' => 'admin/'], function () {
		    Route::auth();
		});

		Route::group(['middleware' => 'auth'], function () {
				//xEbuy 商城系统
	            require 'Routes/Admin/xEbuy.php';
	            require 'Routes/Admin/xAd.php';
	            require 'Routes/Admin/xApi.php';
	            require 'Routes/Admin/xSystem.php';
		
		});
	});







