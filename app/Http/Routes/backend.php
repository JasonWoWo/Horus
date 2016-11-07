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

Route::group(
    [
        'middleware' => ['web']
    ], 
    function () {
        Route::get('auth/login', 'Auth\AuthController@getLogin');
        Route::post('auth/postLogin', 'Auth\AuthController@postLogin');
        Route::get('auth/register', 'Auth\AuthController@getRegister');
        Route::post('auth/register', 'Auth\AuthController@postRegister');
        Route::any('auth/logout', 'Auth\AuthController@getLogout')->name('backend-logout');
        Route::group(
            [
                'middleware' => ['auth']
            ], 
            function () {
                Route::group([
                    'prefix' => 'backend',
                    'middleware' => ['side.bar']
                ], function () {
                    Route::get('/manager', 'Frontend\ManagerController@homeView')->name('home');
                    Route::get('/user', 'Frontend\UserController@homeView');
                    Route::get('/brandMgr', 'Frontend\BrandController@homeView');
                });
                Route::resource('manager', 'Frontend\ManagerController');
                Route::resource('user', 'Frontend\UserController');
                Route::resource('brandMgr', 'Frontend\BrandController');
            }
        );
    }
);