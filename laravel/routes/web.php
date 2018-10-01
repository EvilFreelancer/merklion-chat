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

Route::get('/', function () {
    return redirect('rooms');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/rooms', 'Home@index');
    Route::get('/rooms/{room}', 'Home@index');

    Route::post('/messages', 'Messages@create');
});

Auth::routes();
