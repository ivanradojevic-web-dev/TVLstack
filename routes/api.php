<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->group(function() {

    //Route::get('/user', function () {
    //	return $request->user();
	//});

	Route::get('/auth-user', 'AuthUserController@show');

    Route::apiResource('friend-request', 'FriendRequestController');
    Route::apiResource('friend-request-response', 'FriendRequestResponseController');

	Route::get('/posts', 'PostController@index');
    Route::post('/posts', 'PostController@store');
    Route::get('/posts/user/{user}', 'PostController@userposts');

    Route::apiResources([
    	'users' => 'UserController',
    
	]);

    
});



