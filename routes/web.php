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

Route::post('/api/users/login', 'Auth\AuthController@login');
Route::get('/api/users/', 'Auth\AuthController@getAuthenticatedUser')->middleware('jwt.verify');

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
