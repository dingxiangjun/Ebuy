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


Route::group(['domain' => 'ebuy.app'], function () {

	Route::group(['prefix' => 'admin/'], function () {
	    Route::auth();
	});

	Route::group(['middleware' => 'auth'], function () {
			//xEbuy 商城系统
            require 'Routes/Admin/xEbuy.php';
            require 'Routes/Admin/xAd.php';
            require 'Routes/Admin/xSystem.php';
			require 'Routes/Admin/xApi.php';
	
	});
});






