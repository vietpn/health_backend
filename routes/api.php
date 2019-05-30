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
    Route::get('/promotions', 'PromotionAPIController@index');
});

Route::group(['prefix' => 'v2', 'middleware' => ['auth_api:api', 'cors'], 'namespace' => 'v2'], function () {

    // Feedback
    Route::get('feedback', 'FeedbackController@index');
    Route::post('feedback', 'FeedbackController@store');
    Route::get('feedback/{feedback}', 'FeedbackController@show');

    Route::get('/user/about', ['as' => 'v2.user.about', 'uses' => 'UserController@about']);
    Route::post('/user/upload-avatar', ['as' => 'v2.user.uploadAvatar', 'uses' => 'UserController@uploadAvatar']);
    Route::post('/user/update-profile', ['as' => 'v2.user.updateProfile', 'uses' => 'UserController@updateProfile']);
    Route::get('/user/search-profile', ['as' => 'v2.user.searchProfile', 'uses' => 'UserController@searchProfile']);
    Route::get('/user/search-history', ['as' => 'v2.user.searchHistory', 'uses' => 'UserController@searchHistory']);
    Route::post('/user/block', ['as' => 'v2.user.block', 'uses' => 'UserController@blockProfile']);
    Route::post('/user/un-block', ['as' => 'v2.user.unBlock', 'uses' => 'UserController@unBlockProfile']);
    Route::post('/user/favorite-profile', ['as' => 'v2.user.favorite', 'uses' => 'UserController@favoriteProfile']);
    Route::post('/user/un-favorite-profile', ['as' => 'v2.user.unFavorite', 'uses' => 'UserController@unFavoriteProfile']);
    Route::post('/user/report', ['as' => 'v2.user.report', 'uses' => 'UserController@reportProfile']);
    Route::post('/user/update-online', ['as' => 'v2.user.updateOnline', 'uses' => 'UserController@updateOnline']);
    Route::post('/user/update-location', ['as' => 'v2.user.updateLocation', 'uses' => 'UserController@updateLocation']);
    Route::post('/user/buy-item', ['as' => 'v2.user.buyItem', 'uses' => 'UserController@buyItem']);
    Route::post('/user/item-list-by-user', ['as' => 'v2.user.itemListByUser', 'uses' => 'UserController@itemListByUser']);
    Route::get('/user/category-list-by-user', ['as' => 'v2.user.categoryListByUser', 'uses' => 'UserController@categoryListByUser']);
    Route::post('/user/favorite-post', ['as' => 'v2.user.favorite-post', 'uses' => 'UserController@favoritePost']);
    Route::post('/user/un-favorite-post', ['as' => 'v2.user.unFavorite-post', 'uses' => 'UserController@unFavoritePost']);
    Route::get('/user/search-favorite-profile', ['as' => 'v2.user.searchFavoriteProfile', 'uses' => 'UserController@searchFavoriteProfile']);
    Route::get('/user/list-favorite-post', ['as' => 'v2.user.listFavoritePost', 'uses' => 'UserController@listFavoritePost']);
    Route::post('/user/update-profile-business', ['as' => 'v2.user.updateProfileBusiness', 'uses' => 'UserController@updateProfileBusiness']);
    Route::post('/user/donate-point', ['as' => 'v2.user.donatePoint', 'uses' => 'UserController@donatePoint']);
    Route::post('/user/change-password', ['as' => 'v2.user.changePassword', 'uses' => 'UserController@changePassword']);
    Route::delete('/user/delete-profile', ['as' => 'v2.user.deleteProfile', 'uses' => 'UserController@deleteProfile']);
    Route::post('/user/change-email', ['as' => 'v2.user.changeEmail', 'uses' => 'UserController@changeEmail']);

    //chat
    Route::post('/user/sent-message', ['as' => 'v2.user.sentMessage', 'uses' => 'MessageController@sentMessage']);
    Route::get('/user/get-messages/{id}', ['as' => 'v2.user.getMessages', 'uses' => 'MessageController@getMessages']);
    Route::get('/user/list-chat', ['as' => 'v2.user.listChat', 'uses' => 'MessageController@listChat']);
    Route::post('/user/update-status-msg', ['as' => 'v2.user.updateStatusMsg', 'uses' => 'MessageController@updateStatusMsg']);

    Route::post('/user/update-status-all-msg', ['as' => 'v2.user.updateStatusAllMsg', 'uses' => 'MessageController@updateStatusAllMsg']);
    //search
    Route::get('/user/search-nearby', ['as' => 'v2.user.searchNearBy', 'uses' => 'UserController@searchNearBy']);
    Route::get('user/search-infor-profile/{userId}', ['as' => 'v2.user.searchInforProfile', 'uses' => 'UserController@searchInforProfile']);
    // Post
    Route::get('/posts', 'PostController@index');
    Route::get('/posts/post-by-user/{userId}', 'PostController@postByUser');
    Route::get('/posts/{id}', 'PostController@show');
    Route::post('/posts', 'PostController@store');
    Route::post('/posts/{posts}', 'PostController@update');
    Route::put('/posts/{posts}', 'PostController@update');
    Route::get('/posts/{posts}', 'PostController@show');
    Route::delete('/posts/{posts}', 'PostController@destroy');

    //search post
    Route::get('/post/search-post', ['as' => 'v2.post.searchPost', 'uses' => 'PostController@searchPost']);

    // Like post
    Route::get('/posts/{posts}/likes', 'PostLikeController@index');
    Route::post('/posts/{posts}/likes', 'PostLikeController@store');
    Route::delete('/posts/{posts}/likes', 'PostLikeController@destroy');

    // View post
    Route::get('/posts/{posts}/views', 'PostViewController@index');
    Route::post('/posts/{posts}/views', 'PostViewController@store');

    // Comment  post
    Route::get('/posts/{posts}/comments', 'PostCommentController@index');
    Route::post('/posts/{posts}/comments', 'PostCommentController@store');
    Route::get('/comments/{comments}', 'PostCommentController@show');
    Route::post('/comments/{comments}', 'PostCommentController@update');
    Route::put('/comments/{comments}', 'PostCommentController@update');
    Route::delete('/comments/{comments}', 'PostCommentController@destroy');

    // Like comment of post
    Route::get('/comments/{comments}/likes', 'PostCommentLikeController@index');
    Route::post('/comments/{comments}/likes', 'PostCommentLikeController@store');
    Route::delete('/comments/{comments}/likes', 'PostCommentLikeController@destroy');

    // Report comment of post
    Route::get('/comments/{comments}/reports', 'PostCommentReportController@index');
    Route::post('/comments/{comments}/reports', 'PostCommentReportController@store');
    Route::delete('/comments/{comments}/reports', 'PostCommentReportController@destroy');

    // Report post
    Route::get('/posts/{posts}/reports', 'PostReportController@index');
    Route::post('/posts/{posts}/reports', 'PostReportController@store');
    Route::delete('/posts/{posts}/reports', 'PostReportController@destroy');

    Route::resource('iap_androids', 'IapAndroidController');
    Route::post('/iap/android-charge', ['as' => 'iap.android-charge', 'uses' => 'IapAndroidController@androidCharge']);

    Route::resource('iap_ios', 'IapIosController');
    Route::post('/iap/ios-charge', ['as' => 'iap.ios-charge', 'uses' => 'IapIosController@iosCharge']);

    //Shop
    Route::resource('category_items', 'CategoryItemController');
    Route::get('/category_items/{id}/items', ['as' => 'category_items.items-by-cate', 'uses' => 'CategoryItemController@getItemsByCate']);
    Route::get('/category_items/{code}/item-by-code', ['as' => 'category_items.items-by-code', 'uses' => 'CategoryItemController@getItemsByCode']);
    Route::resource('items', 'ItemController');
    Route::get('/bussines_types', 'BussinesTypeController@index');
    Route::resource('shops', 'ShopController');

    Route::get('/ng_words', ['as' => 'ngword.index', 'uses' => 'NgWordController@index']);

    Route::get('/pins', ['as' => 'pin.index', 'uses' => 'PinController@index']);
    Route::get('/pins/{id}', ['as' => 'pin.show', 'uses' => 'PinController@show']);
    Route::get('/items/item-set-by-parent/{parent_id}', ['as' => 'item.show', 'uses' => 'ItemController@itemSetByParent']);

    //Route::resource('profile_costumes', 'ProfileCostumeController');
    Route::get('/user/costume', ['as' => 'costume.show', 'uses' => 'ProfileCostumeController@costume']);
    Route::post('/user/set-costume', ['as' => 'costume.update', 'uses' => 'ProfileCostumeController@setCostume']);

    Route::get('/user/pin-history',[ 'as' => 'costume.update', 'uses' => 'ProfilePinHistoryController@pinHistoryProfile']);

});
