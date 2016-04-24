<?php
/**
 * Created by PhpStorm.
 * User: Hoàng
 * Date: 4/12/2016
 * Time: 5:31 PM
 */
Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/insert', 'api\v1\modules\users\UserController@insert');

    Route::post('login', 'api\v1\modules\users\UserController@login');

    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::post('logout', 'api\v1\modules\users\UserController@logout');

        Route::get('test', function () {
            return response()->json(['foo' => 'bar']);
        });
    });
});