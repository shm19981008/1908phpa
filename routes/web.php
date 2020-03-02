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



Route::get('/brand/create','BrandController@create');
Route::post('/brand/store','BrandController@store');
Route::get('/brand','BrandController@index');
Route::get('/brand/edit/{id}','BrandController@edit');
Route::post('/brand/update/{id}','BrandController@update');
Route::get('/brand/destroy/{id}','BrandController@destroy');

//商品
Route::prefix('goods')->group(function(){
	Route::get('/create','GoodsController@create');
	Route::post('/store','GoodsController@store');
	Route::post('/checkOnly','GoodsController@checkOnly');
	Route::get('/','GoodsController@index');
	Route::get('/destroy/{id}','GoodsController@destroy');
	Route::get('/edit/{id}','GoodsController@edit');
	Route::post('/update/{id}','GoodsController@update');
});




//管理员
Route::get('admin/create','AdminController@create');
Route::post('admin/store','AdminController@store');
Route::get('/admin','AdminController@index');
Route::get('admin/destroy/{id}','AdminController@destroy');
Route::get('admin/edit/{id}','AdminController@edit');
Route::post('admin/update/{id}','AdminController@update');


Route::get('/login', 'LoginController@login');
Route::post('/logindo', 'LoginController@logindo');
Route::get('/cate/add', 'CateController@add');
Route::post('/cate/do_add', 'CateController@do_add');
Route::get('/cate/list', 'CateController@list');
Route::get('/cate/del/{id}', 'CateController@del');
Route::get('/cate/edit/{id}', 'CateController@edit');
Route::post('/cate/update/{id}', 'CateController@update');

