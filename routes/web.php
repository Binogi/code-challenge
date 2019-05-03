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

Route::get('/', "SearchController@index");
Route::post('/search', "SearchController@search");
Route::get('/info_artist/{id}', 'SearchController@showartist')->name('info_artist');
Route::get('/info_album/{id}', 'SearchController@showalbum')->name('info_album');
Route::get('/info_track/{id}', 'SearchController@showtrack')->name('info_track');
