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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function() {

    Route::prefix('posts')->group(function() {
        Route::get('/', 'PostController@index')->name('posts.index');
        Route::get('/{id}', 'PostController@show')->name('posts.show');
        Route::post('/', 'PostController@save')->name('posts.save');
        Route::put('/', 'PostController@update')->name('posts.update');
        Route::delete('/{id}', 'PostController@delete')->name('posts.delete');
    });

    Route::prefix('tags')->group(function() {
        Route::get('/', 'TagController@index')->name('tags.index');
        Route::get('/{id}', 'TagController@show')->name('tags.show');
        Route::post('/', 'TagController@save')->name('tags.save');
        Route::put('/', 'TagController@update')->name('tags.update');
        Route::delete('/{id}', 'TagController@delete')->name('tags.delete');
    });

});

