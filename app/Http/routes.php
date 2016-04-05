<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::auth(); 
    Route::get('/home', 'HomeController@index');
});

Route::group([ 'middleware' => 'web', 'prefix'=>'produtos', 'where'=>['id'=>'[0-9]+']], function() {
	Route::get('',['as'=>'produtos', 'uses'=>'ProdutosController@index']);
	Route::get('create',['as'=>'produtos.create', 'uses'=>'ProdutosController@create']);
	Route::post('store',['as'=>'produtos.store', 'uses'=>'ProdutosController@store']);
	Route::get('{id}/destroy',['as'=>'produtos.destroy', 'uses'=>'ProdutosController@destroy']);
	Route::get('{id}/edit',['as'=>'produtos.edit', 'uses'=>'ProdutosController@edit']);
	Route::put('{id}/update',['as'=>'produtos.update', 'uses'=>'ProdutosController@update']);
});

