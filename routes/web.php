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
Route::get('/search', "SearchController@searchAll");
Route::get('/search/findartists', "SearchController@findartists");
Route::get('/search/artist/{artist_id}', 'SearchController@artist');