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

            //Feedback
            Route::get('backend/feedback', ['as'=> 'feedback.index', 'uses' => 'Backend\FeedbackController@index']);
            Route::delete('backend/feedback/{feedback}', ['as'=> 'feedback.destroy', 'uses' => 'Backend\FeedbackController@destroy']);
            Route::get('backend/feedback/{feedback}', ['as'=> 'feedback.show', 'uses' => 'Backend\FeedbackController@show']);

            // Product
            Route::get('backend/products', ['as'=> 'products.index', 'uses' => 'Backend\ProductController@index']);
            Route::post('backend/products', ['as'=> 'products.store', 'uses' => 'Backend\ProductController@store']);
            Route::get('backend/products/create', ['as'=> 'products.create', 'uses' => 'Backend\ProductController@create']);
            Route::put('backend/products/{products}', ['as'=> 'products.update', 'uses' => 'Backend\ProductController@update']);
            Route::patch('backend/products/{products}', ['as'=> 'products.update', 'uses' => 'Backend\ProductController@update']);
            Route::delete('backend/products/{products}', ['as'=> 'products.destroy', 'uses' => 'Backend\ProductController@destroy']);
            Route::get('backend/products/{products}', ['as'=> 'products.show', 'uses' => 'Backend\ProductController@show']);
            Route::get('backend/products/{products}/edit', ['as'=> 'products.edit', 'uses' => 'Backend\ProductController@edit']);

            // Order
            Route::get('backend/orders', ['as'=> 'orders.index', 'uses' => 'Backend\OrderController@index']);
            Route::put('backend/orders/{orders}', ['as'=> 'orders.update', 'uses' => 'Backend\OrderController@update']);
            Route::patch('backend/orders/{orders}', ['as'=> 'orders.update', 'uses' => 'Backend\OrderController@update']);
            Route::delete('backend/orders/{orders}', ['as'=> 'orders.destroy', 'uses' => 'Backend\OrderController@destroy']);
            Route::get('backend/orders/{orders}', ['as'=> 'orders.show', 'uses' => 'Backend\OrderController@show']);
            Route::get('backend/orders/{orders}/edit', ['as'=> 'orders.edit', 'uses' => 'Backend\OrderController@edit']);
        });
        Route::get('/unauthorized', ['as' => 'admin.backend.unauthorized', 'role' => ['backend'], 'uses' => 'Backend\HomeController@getUnauthorized']);
        Route::get('/logout', array('as' => 'backend.logout', 'role' => ['backend'], 'uses' => "Backend\HomeController@getLogout"));
    });
});








