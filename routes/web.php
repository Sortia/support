<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('claim', 'ClaimController');

    Route::post('/claim/{claim}/accept', 'ClaimController@accept')->name('claim.accept')->middleware('manager');
    Route::post('/claim/{claim}/close', 'ClaimController@close')->name('claim.close')->middleware('client');

    Route::get('/file/{message}', 'FileController@get')->name('file.get');
});

Route::get('/claim/{claim:shortcode}/auth', 'ClaimController@auth')->name('claim.auth');

