<?php
/**
 * Created by PhpStorm.
 * User: Ho�ng
 * Date: 4/12/2016
 * Time: 5:31 PM
 */
Route::group(['prefix' => 'api/v1/forwebsite'], function () {
    Route::get('/test', 'api\v1\modules\forwebsite\subscriber\SubscriberController@test');

    Route::post('/insert', 'api\v1\modules\forwebsite\subscriber\SubscriberController@insertsubscriber');
    Route::post('register_subscriber','api\v1\modules\forwebsite\UserController@login');
    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::post('logout', 'api\v1\modules\users\UserController@logout');


    });
});