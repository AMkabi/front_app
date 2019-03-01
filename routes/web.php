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

//Route::get('/', function () {
//    return view('welcome');
//});

// ログイン系は、Laravelのデフォルトのを使う
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// 以降、ルーティングはVueで
Route::get('/{any}', function () {
    return view('layouts/vue_app');
})
->where('any', '.*')->middleware('auth');



