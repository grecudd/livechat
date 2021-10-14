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


Route::resource('chats', 'App\Http\Controllers\ChatsController')->middleware('auth');
Route::get('/', 'App\Http\Controllers\ChatsController@index')->middleware('auth');
Route::post('/chats/{chat}/sendMessage', 'App\Http\Controllers\ChatsController@sendMessage')->name('sendMessage');
Route::get('/profiles/{profile}', 'App\Http\Controllers\ChatsController@showProfile')->name('profile');
Route::get('/chats/{chat}/add-users', 'App\Http\Controllers\ChatsController@addUsers')->name('chats.add_users');
Route::post('/chats/store-users', 'App\Http\Controllers\ChatsController@storeUsers')->name('chats.store_users');
Route::get('/logOut', 'App\Http\Controllers\ChatsController@logOut')->name('logOut');
