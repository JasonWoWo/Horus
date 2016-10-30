<?php
// 通过RouteServiceProvider将文件加载

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

Route::group([
    'prefix' => 'api',  // http://localhost:8000/api/auth/item?token=12234   prefix 需要带上前缀  http://localhost:8000/auth/item?token=12234 (X)
    'middleware' => ['jwt.auth'],
], function () {
    Route::any('auth/authenticate', 'Frontend\AuthController@authenticate')->middleware('throttle:5');
    Route::any('auth/item', 'Frontend\AuthController@testTokenItems');
});