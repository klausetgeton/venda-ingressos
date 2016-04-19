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


Route::get('/roles', ['as'=>'roles.index','middleware' => 'role:admin','uses'=>'RolesController@index']);
Route::get('/roles/create', ['as'=>'roles.create','middleware' => 'role:admin','uses'=>'RolesController@create']);
Route::post('/roles/store', ['as'=>'roles.store','middleware' => 'role:admin','uses'=>'RolesController@store']);
Route::get('/roles/edit/{id}', ['as'=>'roles.edit','middleware' => 'role:admin','uses'=>'RolesController@edit']);
Route::put('/roles/update/{id}',['as'=>'roles.update','middleware' => 'role:admin', 'uses'=>'RolesController@update']);
Route::get('/roles/delete/{id}',['as'=>'roles.delete', 'middleware' => 'role:admin', 'uses'=>'RolesController@delete']);	

Route::get('/users', [	'as'=>'users.index',	'middleware' => 'role:admin',	'uses'=>'UsersController@index']);
Route::get('/users/create', ['as'=>'users.create', 'middleware' => 'role:admin', 'uses'=>'UsersController@create']);
Route::post('/users/store', ['as'=>'users.store', 'middleware' => 'role:admin','uses'=>'UsersController@store']);
Route::get('/users/edit/{id}', ['as'=>'users.edit', 'middleware' => 'role:admin','uses'=>'UsersController@edit']);
Route::put('/users/update/{id}',['as'=>'users.update', 'middleware' => 'role:admin', 'uses'=>'UsersController@update']);
Route::get('/users/delete/{id}',['as'=>'users.delete', 'middleware' => 'role:admin', 'uses'=>'UsersController@delete']);	


Route::get('/permission.denied', function () {
    return view('errors.permissionDenied');
});