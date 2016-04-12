<?php
/**
 * Created by PhpStorm.
 * User: Hoàng
 * Date: 4/12/2016
 * Time: 5:31 PM
 */
Route::group(['prefix' => 'api/v1'], function () {
//    Route::get('/insert', 'api\v1\UserController@insert');

    Route::post('login', 'api\v1\UserController@login');

    Route::group(['middleware' => ['jwt.auth', 'jwt.refresh']], function () {
        Route::post('logout', 'api\v1\UserController@logout');

        Route::get('test', function () {
            return response()->json(['foo' => 'bar']);
        });
    });
});