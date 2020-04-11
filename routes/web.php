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
    return view('welcome');
});

Route::get('/game', function () {
    return Redirect('/');
});

Route::get('/game/new', 'GameController@new');
Route::get('/game/{code}', 'GameController@join');
Route::get('/game/{code}/play', 'GameController@play');
Route::get('/game/{code}/{playerId}', 'GameController@createPlayerCookie');
