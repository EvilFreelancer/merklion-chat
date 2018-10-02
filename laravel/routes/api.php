<?php

use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\Messages;
use App\Models\Users;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('rooms')->group(function () {

    Route::get('', function() {
        return Rooms::all();
    });

    Route::get('{id}', function($id) {
        return Rooms::find($id);
    });

});

Route::prefix('users')->group(function () {

    Route::get('', function() {
        return Users::all();
    });

    Route::get('{id}', function($id) {
        return Users::find($id);
    });

});
