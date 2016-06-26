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


Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'admin'], function () {

    	//auditiog
		Route::get('auditing', ['as'=>'auditing.index','uses'=>'AuditoriaController@index']);

		//roles
        Route::get('roles', ['as'=>'roles.index','middleware' => 'role:admin','uses'=>'RolesController@index']);
		Route::get('roles/create', ['as'=>'roles.create','middleware' => 'role:admin','uses'=>'RolesController@create']);
		Route::post('roles/store', ['as'=>'roles.store','middleware' => 'role:admin','uses'=>'RolesController@store']);
		Route::get('roles/edit/{id}', ['as'=>'roles.edit','middleware' => 'role:admin','uses'=>'RolesController@edit']);
		Route::put('roles/update/{id}',['as'=>'roles.update','middleware' => 'role:admin', 'uses'=>'RolesController@update']);
		Route::get('roles/delete/{id}',['as'=>'roles.delete', 'middleware' => 'role:admin', 'uses'=>'RolesController@delete']);

		//users
		Route::get('users', ['as'=>'users.index',	'middleware' => 'role:admin',	'uses'=>'UsersController@index']);
		Route::get('users/create', ['as'=>'users.create', 'middleware' => 'role:admin', 'uses'=>'UsersController@create']);
		Route::post('users/store', ['as'=>'users.store', 'middleware' => 'role:admin','uses'=>'UsersController@store']);
		Route::get('users/edit/{id}', ['as'=>'users.edit', 'middleware' => 'role:admin','uses'=>'UsersController@edit']);
		Route::put('users/update/{id}',['as'=>'users.update', 'middleware' => 'role:admin', 'uses'=>'UsersController@update']);
		Route::get('users/delete/{id}',['as'=>'users.delete', 'middleware' => 'role:admin', 'uses'=>'UsersController@delete']);

		//permissions
		Route::get('permissions/{type?}', ['as'=>'permissions.index',	'middleware' => 'role:admin',	'uses'=>'PermissionsController@index']);
		Route::post('permissions/table/{type?}/{id?}', ['as'=>'permissions.table',	'middleware' => 'role:admin',	'uses'=>'PermissionsController@getTable']);
		Route::get('permissions/create/{type?}', ['as'=>'permissions.create', 'middleware' => 'role:admin', 'uses'=>'PermissionsController@create']);
		Route::post('permissions/store/{type?}', ['as'=>'permissions.store',	'middleware' => 'role:admin',	'uses'=>'PermissionsController@store']);

		//places
		Route::get('places', ['as'=>'places.index',	'middleware' => 'role:admin',	'uses'=>'PlacesController@index']);
		Route::get('places/create', ['as'=>'places.create', 'middleware' => 'role:admin', 'uses'=>'PlacesController@create']);
		Route::post('places/store', ['as'=>'places.store', 'middleware' => 'role:admin','uses'=>'PlacesController@store']);
		Route::get('places/edit/{id}', ['as'=>'places.edit', 'middleware' => 'role:admin','uses'=>'PlacesController@edit']);
		Route::put('places/update/{id}',['as'=>'places.update', 'middleware' => 'role:admin', 'uses'=>'PlacesController@update']);
		Route::get('places/delete/{id}',['as'=>'places.delete', 'middleware' => 'role:admin', 'uses'=>'PlacesController@delete']);

		//events
		Route::get('events', ['as'=>'events.index',	'middleware' => 'role:admin',	'uses'=>'EventsController@index']);
		Route::get('events/create', ['as'=>'events.create', 'middleware' => 'role:admin', 'uses'=>'EventsController@create']);
		Route::post('events/store', ['as'=>'events.store', 'middleware' => 'role:admin','uses'=>'EventsController@store']);
		Route::get('events/edit/{id}', ['as'=>'events.edit', 'middleware' => 'role:admin','uses'=>'EventsController@edit']);
		Route::put('events/update/{id}',['as'=>'events.update', 'middleware' => 'role:admin', 'uses'=>'EventsController@update']);
		Route::get('events/delete/{id}',['as'=>'events.delete', 'middleware' => 'role:admin', 'uses'=>'EventsController@delete']);
		Route::get('events/finish/{id}',['as'=>'events.finish', 'middleware' => 'role:admin', 'uses'=>'EventsController@finish']);


		//sponsors
		Route::get('sponsors', ['as'=>'sponsors.index',	'middleware' => 'role:admin',	'uses'=>'SponsorsController@index']);
		Route::get('sponsors/create', ['as'=>'sponsors.create',	'middleware' => 'role:admin',	'uses'=>'SponsorsController@create']);
		Route::post('sponsors/store', ['as'=>'sponsors.store',	'middleware' => 'role:admin',	'uses'=>'SponsorsController@store']);
		Route::post('sponsors/edit/{id}', ['as'=>'sponsors.edit', 'middleware' => 'role:admin','uses'=>'SponsorsController@edit']);
		Route::post('sponsors/delete/{id}',['as'=>'sponsors.delete', 'middleware' => 'role:admin', 'uses'=>'SponsorsController@delete']);

		//discounts
		Route::get('discounts', ['as'=>'discounts.index',	'middleware' => 'role:admin',	'uses'=>'DiscountsController@index']);
		Route::get('discounts/create', ['as'=>'discounts.create',	'middleware' => 'role:admin',	'uses'=>'DiscountsController@create']);
		Route::post('discounts/store', ['as'=>'discounts.store',	'middleware' => 'role:admin',	'uses'=>'DiscountsController@store']);
		Route::post('discounts/edit/{id}', ['as'=>'discounts.edit', 'middleware' => 'role:admin','uses'=>'DiscountsController@edit']);
		Route::put('discounts/update/{id}',['as'=>'discounts.update', 'middleware' => 'role:admin', 'uses'=>'DiscountsController@update']);
		Route::post('discounts/delete/{id}',['as'=>'discounts.delete', 'middleware' => 'role:admin', 'uses'=>'DiscountsController@delete']);

		//lots
		Route::get('lots', ['as'=>'lots.index',	'middleware' => 'role:admin',	'uses'=>'LotsController@index']);
		Route::get('lots/create', ['as'=>'lots.create',	'middleware' => 'role:admin',	'uses'=>'LotsController@create']);
		Route::post('lots/store', ['as'=>'lots.store',	'middleware' => 'role:admin',	'uses'=>'LotsController@store']);
		Route::post('lots/edit/{id}', ['as'=>'lots.edit', 'middleware' => 'role:admin','uses'=>'LotsController@edit']);
		Route::post('lots/delete/{id}',['as'=>'lots.delete', 'middleware' => 'role:admin', 'uses'=>'LotsController@delete']);
		Route::get('lots/json/{events_id}', ['as' => 'lots.json', 'uses' => 'LotsController@getJsonListByEvent']);

		//SoldTicket
  		Route::get('tickets', ['as'=>'tickets.index',	'middleware' => 'role:admin',	'uses'=>'SoldTicketController@index']);
  		Route::get('tickets/json/{users_id}', ['as'=>'tickets.json',	'middleware' => 'role:admin',	'uses'=>'SoldTicketController@getJsonListByUser'])->where('users_id', '[0-9]+');
    });

});


Route::get('/permission.denied', function () {
    return view('errors.permissiondenied');
});

Route::get('/datatables.data/{model}', [
    'as' => 'datatables.data',
    'uses' => 'DatatablesController@anyData'
]);

Route::get('/seek/{model?}/{search_column?}/{id?}', [
	'as' => 'seek.data',
	'uses' => 'SeekController@findById'
]);

Route::get('select2.data/{model}/{column}', ['as'=>'select2.data', 'middleware' => 'role:admin','uses'=>'Select2Controller@getData']);


// API

Route::get('/bbb', function(){
    return "asdasd";
});

// https://github.com/dingo/api/wiki/Creating-API-Endpoints
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function($api) {
  	$api->post('authenticate', 'App\Http\Controllers\APIController@authenticate');
  	$api->post('register', 'App\Http\Controllers\APIController@register');
  	$api->get('events/json', 'App\Http\Controllers\EventsController@getJsonList');
  	/**
  	 * MOVER PARA A AUTENTICADA DEPOIS
  	 */
  	//PurchasePossibility
  	$api->get('pp/json/{events_id}', 'App\Http\Controllers\PurchasePossibilityController@getJsonListByEvent');
});

$api->version('v1', ['middleware' => 'api.auth'], function($api) {
  	$api->get('user', 'App\Http\Controllers\APIController@getJsonUser');
  	//SoldTicket
  	$api->get('tickets/user/json', 'App\Http\Controllers\SoldTicketController@getJsonList');
  	$api->post('tickets/store', 'App\Http\Controllers\SoldTicketController@store');
});
