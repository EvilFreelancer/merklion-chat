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

Route::prefix('messages')->group(function () {

    Route::get('', function() {
        return Messages::all();
    });

    Route::get('{id}', function($id) {
        return Messages::find($id);
    });

    Route::post('', function(Request $request) {
        return Messages::create($request->all);
    });

    Route::put('{id}', function(Request $request, $id) {
        $article = Messages::findOrFail($id);
        $article->update($request->all());
        return $article;
    });

    Route::delete('{id}', function($id) {
        Messages::find($id)->delete();
        return 204;
    });

});

Route::prefix('rooms')->group(function () {

    Route::get('', function() {
        return Rooms::all();
    });

    Route::get('{id}', function($id) {
        return Rooms::find($id);
    });

    Route::post('', function(Request $request) {
        return Rooms::create($request->all);
    });

    Route::put('{id}', function(Request $request, $id) {
        $article = Rooms::findOrFail($id);
        $article->update($request->all());
        return $article;
    });

    Route::delete('{id}', function($id) {
        Rooms::find($id)->delete();
        return 204;
    });

});

Route::prefix('users')->group(function () {

    Route::get('', function() {
        return Users::all();
    });

    Route::get('{id}', function($id) {
        return Users::find($id);
    });

    Route::post('', function(Request $request) {
        return Users::create($request->all);
    });

    Route::put('{id}', function(Request $request, $id) {
        $article = Users::findOrFail($id);
        $article->update($request->all());
        return $article;
    });

    Route::delete('{id}', function($id) {
        Users::find($id)->delete();
        return 204;
    });

});
