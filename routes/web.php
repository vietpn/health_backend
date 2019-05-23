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

    Route::group(['middleware' => ['SentinelCheck', 'sentinelHasAccess']], function () {

        Route::group(['as' => 'backend.'], function () {
            Route::resource('iapAndroids', 'Backend\IapAndroidController');
            Route::resource('iapIos', 'Backend\IapIosController');
            Route::resource('configs', 'Backend\ConfigController');
            Route::resource('pages', 'Backend\PageController');
            Route::resource('iapAndroidChargings', 'Backend\IapAndroidChargingController');
            Route::resource('iapIosChargings', 'Backend\IapIosChargingController');
            Route::resource('pointConfigs', 'Backend\PointConfigController');
            Route::resource('messages', 'Backend\MessageController');
            Route::delete('/messages/delete/{id}', ['as' => 'messages.destroy', 'uses' => 'Backend\MessageController@delete']);

            Route::resource('profileItemHistories', 'Backend\ProfileItemHistoryController');

            //Shop
            Route::resource('categoryItems', 'Backend\CategoryItemController');
            Route::resource('items', 'Backend\ItemController');
            //Route::resource('bussinesTypes', 'Backend\BussinesTypeController');
            //Route::resource('shops', 'Backend\ShopController');

            Route::resource('pins', 'Backend\PinController');

            // Profile report
            Route::get('/profile-reports', ['as' => 'profileReports.index', 'uses' => 'Backend\ProfileReportController@index']);
            Route::post('/profile-reports', ['as' => 'profileReports.store', 'uses' => 'Backend\ProfileReportController@store']);
            Route::put('/profile-reports/{profileReports}', ['as' => 'profileReports.update', 'uses' => 'Backend\ProfileReportController@update']);
            Route::patch('/profile-reports/{profileReports}', ['as' => 'profileReports.update', 'uses' => 'Backend\ProfileReportController@update']);
            Route::delete('/profile-reports/{profileReports}', ['as' => 'profileReports.destroy', 'uses' => 'Backend\ProfileReportController@destroy']);
            Route::get('/profile-reports/{profileReports}', ['as' => 'profileReports.show', 'uses' => 'Backend\ProfileReportController@show']);
            Route::get('/profile-reports/{profileReports}/edit', ['as' => 'profileReports.edit', 'uses' => 'Backend\ProfileReportController@edit']);

            // Profile block
            Route::get('/profile-blocks', ['as' => 'profileBlocks.index', 'uses' => 'Backend\ProfileBlockController@index']);
            Route::get('/profile-blocks/{profileBlocks}', ['as' => 'profileBlocks.show', 'uses' => 'Backend\ProfileBlockController@show']);
            Route::delete('/profile-blocks/{profileBlocks}', ['as' => 'profileBlocks.destroy', 'uses' => 'Backend\ProfileBlockController@destroy']);

            // Profile favorite
            Route::get('/profile-favorites', ['as' => 'profileFavorites.index', 'uses' => 'Backend\ProfileFavoriteController@index']);
            Route::get('/profile-favorites/{profileFavorites}', ['as' => 'profileFavorites.show', 'uses' => 'Backend\ProfileFavoriteController@show']);
            Route::delete('/profile-favorites/{profileFavorites}', ['as' => 'profileFavorites.destroy', 'uses' => 'Backend\ProfileFavoriteController@destroy']);

            // Local stream
            Route::get('/posts', ['as' => 'posts.index', 'uses' => 'Backend\PostController@index']);
            Route::delete('/posts/{posts}', ['as' => 'posts.destroy', 'uses' => 'Backend\PostController@destroy']);
            Route::get('/posts/{posts}', ['as' => 'posts.show', 'uses' => 'Backend\PostController@show']);
            Route::get('/posts/{posts}/edit', ['as' => 'posts.edit', 'uses' => 'Backend\PostController@edit']);
            Route::get('/comments/{postId}', ['as' => 'comments.index', 'uses' => 'Backend\PostController@showComment']);
            Route::delete('/comments/{commentId}', ['as' => 'comments.destroy', 'uses' => 'Backend\PostController@destroyComment']);


            Route::resource('ngWords', 'Backend\NgWordController');
            //profile
            Route::get('profiles', ['as' => 'profiles.index', 'uses' => 'Backend\ProfileController@index']);
            Route::delete('profiles/{profiles}', ['as' => 'profiles.destroy', 'uses' => 'Backend\ProfileController@destroy']);
            Route::get('profiles/{profiles}', ['as' => 'profiles.show', 'uses' => 'Backend\ProfileController@show']);
            Route::post('profiles/ban-nick', ['as' => 'profiles.edit', 'uses' => 'Backend\ProfileController@banNick']);
            Route::get('profiles/show-point/{id}', ['as' => 'profiles.show_point', 'role' => ['backend.profiles.show_point'], 'uses' => 'Backend\ProfileController@showPoint']);
            Route::post('profiles/active-nick/', ['as' => 'profiles.active_nick', 'role' => ['backend.profiles.update'], 'uses' => 'Backend\ProfileController@activeNick']);
            Route::get('profiles/show-ban-nick/{id}', ['as' => 'profiles.show_ban_nick', 'role' => ['backend.profiles.view'], 'uses' => 'Backend\ProfileController@showBanNick']);

            //rank config
            Route::get('rankConfigs', ['as' => 'rankConfigs.index', 'uses' => 'Backend\RankConfigController@index']);
            Route::post('rankConfigs', ['as' => 'rankConfigs.store', 'uses' => 'Backend\RankConfigController@store']);
            Route::get('rankConfigs/create', ['as' => 'rankConfigs.create', 'uses' => 'Backend\RankConfigController@create']);
            Route::put('rankConfigs/{rankConfigs}', ['as' => 'rankConfigs.update', 'uses' => 'Backend\RankConfigController@update']);
            Route::patch('rankConfigs/{rankConfigs}', ['as' => 'rankConfigs.update', 'uses' => 'Backend\RankConfigController@update']);
            Route::delete('rankConfigs/{rankConfigs}', ['as' => 'rankConfigs.destroy', 'uses' => 'Backend\RankConfigController@destroy']);
            Route::get('rankConfigs/{rankConfigs}', ['as' => 'rankConfigs.show', 'uses' => 'Backend\RankConfigController@show']);
            Route::get('rankConfigs/{rankConfigs}/edit', ['as' => 'rankConfigs.edit', 'uses' => 'Backend\RankConfigController@edit']);

            // Business
            Route::get('profileBusinesses', ['as' => 'profileBusinesses.index', 'uses' => 'Backend\ProfileBusinessController@index']);
            Route::delete('profileBusinesses/{postId}', ['as' => 'profileBusinesses.destroy', 'uses' => 'Backend\ProfileBusinessController@destroy']);
            Route::get('profileBusinesses/{postId}', ['as' => 'profileBusinesses.show', 'uses' => 'Backend\ProfileBusinessController@show']);

            Route::get('profileBusinesses', ['as'=> 'profileBusinesses.index', 'uses' => 'Backend\ProfileBusinessController@index']);
            Route::put('profileBusinesses/{profileBusinesses}', ['as'=> 'profileBusinesses.update', 'uses' => 'Backend\ProfileBusinessController@update']);
            Route::patch('profileBusinesses/{profileBusinesses}', ['as'=> 'profileBusinesses.update', 'uses' => 'Backend\ProfileBusinessController@update']);
            Route::delete('profileBusinesses/{profileBusinesses}', ['as'=> 'profileBusinesses.destroy', 'uses' => 'Backend\ProfileBusinessController@destroy']);
            Route::get('profileBusinesses/{profileBusinesses}', ['as'=> 'profileBusinesses.show', 'uses' => 'Backend\ProfileBusinessController@show']);
            Route::get('profileBusinesses/{profileBusinesses}/edit', ['as'=> 'profileBusinesses.edit', 'uses' => 'Backend\ProfileBusinessController@edit']);
            //charge point
            Route::get('backend/chargePoints', ['as'=> 'chargePoints.index', 'uses' => 'Backend\ChargePointController@index']);
            Route::post('backend/chargePoints', ['as'=> 'chargePoints.store', 'uses' => 'Backend\ChargePointController@store']);
            Route::get('backend/chargePoints/create', ['as'=> 'chargePoints.create', 'uses' => 'Backend\ChargePointController@create']);
            Route::put('backend/chargePoints/{chargePoints}', ['as'=> 'chargePoints.update', 'uses' => 'Backend\ChargePointController@update']);
            Route::patch('backend/chargePoints/{chargePoints}', ['as'=> 'chargePoints.update', 'uses' => 'Backend\ChargePointController@update']);
            Route::delete('backend/chargePoints/{chargePoints}', ['as'=> 'chargePoints.destroy', 'uses' => 'Backend\ChargePointController@destroy']);
            Route::get('backend/chargePoints/{chargePoints}', ['as'=> 'chargePoints.show', 'uses' => 'Backend\ChargePointController@show']);
            Route::get('backend/chargePoints/{chargePoints}/edit', ['as'=> 'chargePoints.edit', 'uses' => 'Backend\ChargePointController@edit']);
        });

        // Permission
        Route::group(['as' => 'admin.', 'prefix' => 'permissions', 'namespace' => 'Backend\Permission'], function () {
            Route::resource('roles', 'RoleController');
            Route::resource('user', 'UserController');
            Route::get('user/change_password/{id}', ['as' => 'user.change_password', 'role' => ['admin.user.change_password'], 'uses' => 'UserController@changePassword']);
            Route::put('users/post_change_password/{id}', array('as' => 'user.change_password_put', 'role' => ['admin.user.change_password'], 'uses' => 'UserController@postChangePassword'));
            Route::delete('user/delete/{id}', array('as' => 'user.delete', 'role' => ['admin.user.delete'], 'uses' => 'UserController@destroy'));
            Route::delete('roles/delete/{id}', array('as' => 'roles.delete', 'role' => ['admin.roles.delete'], 'uses' => 'RoleController@destroy'));
        });
        Route::get('/unauthorized', ['as' => 'admin.backend.unauthorized', 'role' => ['backend'], 'uses' => 'Backend\HomeController@getUnauthorized']);
        Route::get('/logout', array('as' => 'backend.logout', 'role' => ['backend'], 'uses' => "Backend\HomeController@getLogout"));
    });
});





