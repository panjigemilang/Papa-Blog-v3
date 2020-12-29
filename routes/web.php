<?php

use Illuminate\Support\Facades\Route;

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

Route::post('/api/posts/addPost', 'Post\PostController@addPost');
Route::get('/api/posts/getAllPosts', 'Post\PostController@getAllPosts');
// Route::get('/api/users/', 'Auth\AuthController@getAuthenticatedUser')->middleware('jwt.verify');

Route::middleware('jwt.verify')->group(function() {
    Route::get('/api/users/', 'Auth\AuthController@getAuthenticatedUser');
});

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
