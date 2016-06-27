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

    	//auditing
		Route::get('auditing', ['as'=>'auditing.index','uses'=>'AuditoriaController@index']);

		//roles
        Route::get('roles', ['as'=>'roles.index','middleware' => 'permission:role.view','uses'=>'RolesController@index']);
		Route::get('roles/create', ['as'=>'roles.create','middleware' => 'permission:role.create','uses'=>'RolesController@create']);
		Route::post('roles/store', ['as'=>'roles.store','middleware' => 'permission:role.create','uses'=>'RolesController@store']);
		Route::get('roles/edit/{id}', ['as'=>'roles.edit','middleware' => 'permission:role.edit','uses'=>'RolesController@edit']);
		Route::put('roles/update/{id}',['as'=>'roles.update','middleware' => 'permission:role.edit', 'uses'=>'RolesController@update']);
		Route::get('roles/delete/{id}',['as'=>'roles.delete', 'middleware' => 'permission:role.delete', 'uses'=>'RolesController@delete']);

		//users
		Route::get('users', ['as'=>'users.index',	'middleware' => 'permission:user.view',	'uses'=>'UsersController@index']);
		Route::get('users/create', ['as'=>'users.create', 'middleware' => 'permission:user.create', 'uses'=>'UsersController@create']);
		Route::post('users/store', ['as'=>'users.store', 'middleware' => 'permission:user.create','uses'=>'UsersController@store']);
		Route::get('users/edit/{id}', ['as'=>'users.edit', 'middleware' => 'permission:user.edit','uses'=>'UsersController@edit']);
		Route::put('users/update/{id}',['as'=>'users.update', 'middleware' => 'permission:user.edit', 'uses'=>'UsersController@update']);
		Route::get('users/delete/{id}',['as'=>'users.delete', 'middleware' => 'permission:user.delete', 'uses'=>'UsersController@delete']);

		//permissions
		Route::get('permissions/{type?}', ['as'=>'permissions.index',	'middleware' => 'permission:permission.view',	'uses'=>'PermissionsController@index']);
		Route::post('permissions/table/{type?}/{id?}', ['as'=>'permissions.table',	'middleware' => 'permission:permission.edit',	'uses'=>'PermissionsController@getTable']);
		Route::get('permissions/create/{type?}', ['as'=>'permissions.create', 'middleware' => 'permission:permission.create', 'uses'=>'PermissionsController@create']);
		Route::post('permissions/store/{type?}', ['as'=>'permissions.store',	'middleware' => 'permission:permission.create',	'uses'=>'PermissionsController@store']);

		//places
		Route::get('places', ['as'=>'places.index',	'middleware' => 'permission:place.view',	'uses'=>'PlacesController@index']);
		Route::get('places/create', ['as'=>'places.create', 'middleware' => 'permission:place.create', 'uses'=>'PlacesController@create']);
		Route::post('places/store', ['as'=>'places.store', 'middleware' => 'permission:place.create','uses'=>'PlacesController@store']);
		Route::get('places/edit/{id}', ['as'=>'places.edit', 'middleware' => 'permission:place.edit','uses'=>'PlacesController@edit']);
		Route::put('places/update/{id}',['as'=>'places.update', 'middleware' => 'permission:place.edit', 'uses'=>'PlacesController@update']);
		Route::get('places/delete/{id}',['as'=>'places.delete', 'middleware' => 'permission:place.delete', 'uses'=>'PlacesController@delete']);

		//events
		Route::get('events', ['as'=>'events.index',	'middleware' => 'permission:event.view',	'uses'=>'EventsController@index']);
		Route::get('events/create', ['as'=>'events.create', 'middleware' => 'permission:event.create', 'uses'=>'EventsController@create']);
		Route::post('events/store', ['as'=>'events.store', 'middleware' => 'permission:event.create','uses'=>'EventsController@store']);
		Route::get('events/edit/{id}', ['as'=>'events.edit', 'middleware' => 'permission:event.edit','uses'=>'EventsController@edit']);
		Route::put('events/update/{id}',['as'=>'events.update', 'middleware' => 'permission:event.edit', 'uses'=>'EventsController@update']);
		Route::get('events/delete/{id}',['as'=>'events.delete', 'middleware' => 'permission:event.delete', 'uses'=>'EventsController@delete']);
		Route::get('events/finish/{id}',['as'=>'events.finish', 'middleware' => 'permission:event.create', 'uses'=>'EventsController@finish']);

		//sponsors
		Route::get('sponsors', ['as'=>'sponsors.index',	'middleware' => 'permission:sponsor.view',	'uses'=>'SponsorsController@index']);
		Route::get('sponsors/create', ['as'=>'sponsors.create',	'middleware' => 'permission:sponsor.create',	'uses'=>'SponsorsController@create']);
		Route::post('sponsors/store', ['as'=>'sponsors.store',	'middleware' => 'permission:sponsor.create',	'uses'=>'SponsorsController@store']);
		Route::post('sponsors/edit/{id}', ['as'=>'sponsors.edit', 'middleware' => 'permission:sponsor.edit','uses'=>'SponsorsController@edit']);
		Route::post('sponsors/delete/{id}',['as'=>'sponsors.delete', 'middleware' => 'permission:sponsor.store', 'uses'=>'SponsorsController@delete']);

		//discounts
		Route::get('discounts', ['as'=>'discounts.index',	'middleware' => 'permission:discount.view',	'uses'=>'DiscountsController@index']);
		Route::get('discounts/create', ['as'=>'discounts.create',	'middleware' => 'permission:discount.create',	'uses'=>'DiscountsController@create']);
		Route::post('discounts/store', ['as'=>'discounts.store',	'middleware' => 'permission:discount.create',	'uses'=>'DiscountsController@store']);
		Route::post('discounts/edit/{id}', ['as'=>'discounts.edit', 'middleware' => 'permission:discount.edit','uses'=>'DiscountsController@edit']);
		Route::put('discounts/update/{id}',['as'=>'discounts.update', 'middleware' => 'permission:discount.edit', 'uses'=>'DiscountsController@update']);
		Route::post('discounts/delete/{id}',['as'=>'discounts.delete', 'middleware' => 'permission:discount.delete', 'uses'=>'DiscountsController@delete']);

		//lots
		Route::get('lots', ['as'=>'lots.index',	'middleware' => 'permission:lot.view',	'uses'=>'LotsController@index']);
		Route::get('lots/create', ['as'=>'lots.create',	'middleware' => 'permission:lot.create',	'uses'=>'LotsController@create']);
		Route::post('lots/store', ['as'=>'lots.store',	'middleware' => 'permission:lot.create',	'uses'=>'LotsController@store']);
		Route::post('lots/edit/{id}', ['as'=>'lots.edit', 'middleware' => 'permission:lot.edit','uses'=>'LotsController@edit']);
		Route::post('lots/delete/{id}',['as'=>'lots.delete', 'middleware' => 'permission:lot.delete', 'uses'=>'LotsController@delete']);
		Route::get('lots/json/{events_id}', ['as' => 'lots.json', 'uses' => 'LotsController@getJsonListByEvent']);

		//SoldTicket
  		Route::get('tickets', ['as'=>'tickets.index', 'middleware' => 'permission:soldticket.view', 'uses'=>'SoldTicketController@index']);
  		Route::get('tickets/json/{users_id}', ['as'=>'tickets.json', 'uses'=>'SoldTicketController@getJsonListByUser'])->where('users_id', '[0-9]+');
    });

	Route::get('/datatables.data/{model}', [
	    'as' => 'datatables.data',
	    'uses' => 'DatatablesController@anyData'
	]);

	Route::get('/seek/{model?}/{search_column?}/{id?}', [
		'as' => 'seek.data',
		'uses' => 'SeekController@findById'
	]);

	Route::get('select2.data/{model}/{column}', ['as'=>'select2.data', 'uses'=>'Select2Controller@getData']);
});


Route::get('/permission.denied', function () {
    return view('errors.permissiondenied');
});


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
