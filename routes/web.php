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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', 'LoginController@login');
Route::post('/logindo', 'LoginController@logindo');
Route::get('/cate/add', 'CateController@add');
Route::post('/cate/do_add', 'CateController@do_add');
Route::get('/cate/list', 'CateController@list');
Route::get('/cate/del/{id}', 'CateController@del');
Route::get('/cate/edit/{id}', 'CateController@edit');
Route::post('/cate/update/{id}', 'CateController@update');