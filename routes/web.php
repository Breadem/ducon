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

Route::get('/', 'IndexController@index');

Route::get('/exits', 'IndexController@exits');

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::prefix('bbs')->group(function () {
    Route::get('/', 'InfoController@index');
    Route::get('/create', function () {
    	return view('info/create');
    });
    Route::get('/{id}', 'InfoController@infoDetail');
});

Route::prefix('info')->group(function () {
    Route::get('/', 'InfoController@index');
    Route::post('/create', 'InfoController@save');
    Route::post('/{id}', 'InfoController@infoDetail');
});

Route::prefix('user')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
});
