<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1'], function() use ($router) {

	$router->post('login', [
    	'as' => 'login', 
    	'uses' => 'AdminController@AdminLogin'
	]);

	$router->post('generate_codes', [
		'as' => 'generate_codes', 
    	'uses' => 'AdminController@AdminGenerateCodes'
	]);

	$router->post('create_params', [
		'as' => 'create_params', 
    	'uses' => 'AdminController@AdminCreate'
	]);

	$router->post('read_each_model_by_track_ref', [
		'as' => 'read_track_ref', 
    	'uses' => 'AdminController@AdminGetByTrackOrRef'
	]);

	$router->post('read_all_track_ref', [
		'as' => 'read_all_track_ref', 
    	'uses' => 'AdminController@AdminGetAllTrack_Ref'
	]);

	$router->post('update_params', [
		'as' => 'update_params', 
    	'uses' => 'AdminController@AdminUpdateParams'
	]);

	$router->post('track_shipment', [
		'as' => 'track_shipment', 
    	'uses' => 'UserController@UserTrackShipment'
	]);

});
