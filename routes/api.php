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

Route::get('/jajal/{id}', 'Post\PostController@jajal');

Route::middleware('jwt.verify')->group(function() {
    // For Admin
    Route::get('/users', 'Auth\AuthController@getAuthenticatedUser');
    Route::post('/posts/addPost', 'Post\PostController@addPost');
    Route::post('/post/{id}', 'AdminController@editPost');
    Route::delete('/post/{id}', 'AdminController@deletePost');
});

// Auth
Route::post('/users/login', 'Auth\AuthController@login');

// For Posts
Route::get('posts/{num}', 'PostController@getPosts');
Route::get('tags/{num}', 'Post\TagController@getTags');
Route::get('post/{id}', 'PostController@getPost');
Route::get('post/title/{title}/{num}', 'PostController@searchPost');
Route::get('post/tags/{tags}/{num}', 'PostController@searchPostByTag');

// For User
Route::post('/like/post/{id}', 'UserController@likePost');
Route::post('/comment/post/{id}', 'UserController@commentPost');
Route::get('/comments/{id}', 'UserController@getComments');
Route::get('/likes/{id}', 'UserController@getLikes');
Route::delete('/comment/post/{id}', 'UserController@removeComment');
Route::delete('/like/post/{id}', 'UserController@unlikePost');
Route::get('/profile/{id}', 'UserController@getProfile');
Route::put('/profile', 'UserController@editProfile');
