<?php
/**
 * Created by PhpStorm.
 * User: Ho�ng
 * Date: 4/12/2016
 * Time: 5:31 PM
 */
Route::group(['prefix' => 'api/v1/forshops'], function () {
    Route::get('/insert', 'api\v1\modules\forshops\login\LoginController@insert');

    Route::post('login', 'api\v1\modules\forshops\login\LoginController@login');

    Route::group(['middleware' => ['jwt.auth']], function () {

        Route::post('logout', 'api\v1\modules\forshops\login\LoginController@logout');


        Route::get('categories', 'api\v1\modules\forshops\product\CategoryController@index');
        Route::post('categories', 'api\v1\modules\forshops\product\CategoryController@store');
        Route::put('categories', 'api\v1\modules\forshops\product\CategoryController@update');
        Route::delete('categories', 'api\v1\modules\forshops\product\CategoryController@delete');


        Route::get('products', 'api\v1\modules\forshops\product\ProductController@index');
        Route::post('products', 'api\v1\modules\forshops\product\ProductController@store');
        Route::put('products', 'api\v1\modules\forshops\product\ProductController@update');
        Route::delete('products', 'api\v1\modules\forshops\product\ProductController@delete');


        Route::post('products/image/upload', 'api\v1\modules\forshops\product\ProductController@uploadImage');
        Route::delete('products/image/delete', 'api\v1\modules\forshops\product\ProductController@deleteImage');


    });


});
