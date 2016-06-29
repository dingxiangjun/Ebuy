<?php
/**
 * xApi 接口
 */
Route::group(['namespace' => 'Admin\xApi', 'prefix' => 'admin/xApi'], function () {
    //数据可视化
    Route::get('sales_count', 'VisualizationController@sales_count');
    Route::get('sales_amount', 'VisualizationController@sales_amount');
    Route::get('top', 'VisualizationController@top');
    Route::get('sales_area', 'VisualizationController@sales_area');
});
