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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'PostsController@index')->name('home');
Route::resource('posts', 'PostsController');
Route::resource('tags', 'TagController');

Route::prefix('free-zone')
->group(function () {
    Route::get('hello', 'TestController@guest')->name('free-zone');
});

Route::prefix('restricted-zone')
->middleware('auth')
->group(function () {
    Route::get('hello', 'TestController@logged')->name('restricted-zone');
});
