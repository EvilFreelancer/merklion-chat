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

Route::get('/', function() {
    return redirect('rooms');
});

Route::group(['middleware' => 'web'], function() {

    Route::auth();

    Route::prefix('/rooms')->group(function () {
        // Open VueJS application
        Route::get('', 'Rooms@index');
        // Alias for VueJS
        Route::get('{room_id}', 'Rooms@index');
    });

    Route::prefix('/messages')->group(function () {
        // Get a list of all messages in room
        Route::get('{room_id}', 'Messages@get');
        // Create new in room
        Route::post('', 'Messages@create');
    });

    Route::prefix('/users')->group(function () {

        // Get information about current user
        Route::get('info', function() {
            return \Auth::user();
        });

        // Get user's profile information
        Route::get('profile', 'Users@index')->name('profile');
        // Update user's profile information
        Route::put('update', 'Users@update');
    });

});

Auth::routes();
