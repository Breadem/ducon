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
    // info 帖子路由
    Route::get('/', 'InfoController@index');
    Route::get('/info/create', function () {
        if(\Illuminate\Support\Facades\Auth::check()){
            return view('info/create');
        }abort(401);
    });
    Route::get('/info/{info}/edit',function (App\Info $info) {
        return view('info/edit',['info'=>$info]);
    })->middleware('can:update,info');
    Route::get('/info/{id}', 'InfoController@infoDetail');
    Route::post('/info/create', 'InfoController@save');
    Route::post('/info/{id}/update','InfoController@update');
});

Route::prefix('user')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login')->middleware('throttle:5');
});

