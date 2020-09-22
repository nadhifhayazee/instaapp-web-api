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

Route::post('register', 'Api\UserController@register');
Route::post('login', 'Api\UserController@login');

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/user/{username}', 'Api\UserController@getUser');
    Route::get('/follow/{id}', 'Api\UserController@follow');

    Route::post('/post', 'Api\PostController@create');
    Route::get('/post', 'Api\PostController@index');
    Route::get('/post/{id}', 'Api\PostController@show');
    Route::delete('/post/{id}', 'Api\PostController@remove'); 

    Route::post('/comment', 'Api\CommentController@create');
    Route::get('/comment/{post_id}', 'Api\CommentController@getComments');
    Route::delete('/comment/{id}', 'Api\CommentController@remove');
    

    Route::post('/like', 'Api\LikeController@like');
    Route::post('/unlike/{post_id}', 'Api\LikeController@unlike');

});


