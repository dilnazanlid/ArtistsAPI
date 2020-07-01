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

Route::get('/', function () { return view('main');})->name('main');

Route::get('/artists', 'ArtistController@getAllArtists')->name('artists-all');

Route::get('/artists/{id}', 'ArtistController@getOneArtist')->name('artists-one');
