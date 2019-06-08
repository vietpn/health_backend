<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1', 'middleware' => ['outh_client', 'cors'], 'namespace' => 'v1'], function () {
    Route::post('/user/login', ['as' => 'v1.user.login', 'uses' => 'UserController@login']);

    Route::get('/configs', 'ConfigController@index');
    
    Route::get('/promotions', 'PromotionController@index');
    Route::get('/promotions/{code}', 'PromotionController@code');


    Route::get('/products', 'ProductController@index');
});

Route::group(['prefix' => 'v2', 'middleware' => ['auth_api:api', 'cors'], 'namespace' => 'v2'], function () {

    // Feedback
    Route::get('feedback', 'FeedbackController@index');
    Route::post('feedback', 'FeedbackController@store');
    Route::get('feedback/{feedback}', 'FeedbackController@show');

    // Orders
    Route::get('orders', 'OrderController@index');
    Route::post('orders', 'OrderController@store');
    Route::get('orders/{orders}', 'OrderController@show');
    Route::put('orders/{orders}', 'OrderController@update');
    Route::patch('orders/{orders}', 'OrderController@update');
    Route::delete('orders{orders}', 'OrderController@destroy');

    Route::get('/user/about', ['as' => 'v2.user.about', 'uses' => 'UserController@about']);
    Route::post('/user/change-password', ['as' => 'v2.user.changePassword', 'uses' => 'UserController@changePassword']);
});