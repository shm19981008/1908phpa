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


//管理员
Route::get('admin/create','AdminController@create');
Route::post('admin/store','AdminController@store');
Route::get('/admin','AdminController@index');
Route::get('admin/destroy/{id}','AdminController@destroy');
Route::get('admin/edit/{id}','AdminController@edit');
Route::post('admin/update/{id}','AdminController@update');
