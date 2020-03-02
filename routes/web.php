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