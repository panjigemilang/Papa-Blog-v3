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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('post', 'AdminController@createPost');
Route::put('post/{id}', 'AdminController@editPost');
Route::delete('post/{id}', 'AdminController@deletePost');

Route::get('posts', 'PostController@getPosts');
Route::get('post/{id}', 'PostController@getPost');
Route::get('post/title/{title}', 'PostController@searchPost');
