<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('_home');
});

Route::controllers(
[
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/auditing', ['as'=>'auditing.index','uses'=>'AuditoriaController@index']);


Route::get('/roles', ['as'=>'roles.index','uses'=>'RolesController@index']);
Route::get('/roles/create', ['as'=>'roles.create','uses'=>'RolesController@create']);
Route::post('/roles/store', ['as'=>'roles.store','uses'=>'RolesController@store']);
Route::get('/roles/edit/{id}', ['as'=>'roles.edit','uses'=>'RolesController@edit']);
Route::put('/roles/update/{id}',['as'=>'roles.update', 'uses'=>'RolesController@update']);

Route::get('/users', ['as'=>'users.index','uses'=>'UsersController@index']);
Route::get('/users/create', ['as'=>'users.create','uses'=>'UsersController@create']);
Route::post('/users/store', ['as'=>'users.store','uses'=>'UsersController@store']);
Route::get('/users/edit/{id}', ['as'=>'users.edit','uses'=>'UsersController@edit']);
Route::put('/users/update/{id}',['as'=>'users.update', 'uses'=>'UsersController@update']);




