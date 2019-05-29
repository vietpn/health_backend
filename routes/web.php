<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/page/{alias}', 'PageController@content');

Route::get('/password/reset/{token}', 'PasswordController@resetForm');
Route::get('/password/reset', 'PasswordController@resetForm');
Route::post('/password/reset', 'PasswordController@reset');

Route::get('/', function () {
    return Redirect::route('backend.login');
});

Route::group(['prefix' => 'admin'], function () {
    Route::group([], function () {
        Route::get('/', function () {
            return Redirect::route('backend.login');
        });
        Route::get('/login', ['as' => 'backend.login', 'uses' => 'Backend\HomeController@getLogin']);
        Route::post('/login', ['as' => 'backend.postLogin', 'uses' => 'Backend\HomeController@postLogin']);
    });

    Route::group(['middleware' => ['SentinelCheck']], function () {

        Route::group(['as' => 'backend.'], function () {
            
            //Promotion
            Route::resource('promotions', 'Backend\PromotionController');

            //Profile
            Route::resource('profiles', 'Backend\ProfileController');


        });
        Route::get('/unauthorized', ['as' => 'admin.backend.unauthorized', 'role' => ['backend'], 'uses' => 'Backend\HomeController@getUnauthorized']);
        Route::get('/logout', array('as' => 'backend.logout', 'role' => ['backend'], 'uses' => "Backend\HomeController@getLogout"));
    });
});
