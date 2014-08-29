<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
	'as' 	=> 'home', 
	'uses'  => 'HomeController@getHome'
));

Route::post('/post-event', array(
	'as' 	=> 'post-event',
	'uses' 	=> 'HomeController@postEvent'
));

Route::post('/post-group', array(
	'as' 	=> 'post-group',
	'uses' 	=> 'HomeController@postGroup'
));

Route::post('/post-subgroup', array(
	'as' 	=> 'post-subgroup',
	'uses' 	=> 'HomeController@postSubgroup'
));

Route::post('/post-user', array(
	'as' 	=> 'post-user',
	'uses' 	=> 'HomeController@postUser'
));

// --------------------------------------- //

Route::post('/post-group-to-event', array(
	'as' 	=> 'post-group-to-event',
	'uses' 	=> 'HomeController@postGroupToEvent'
));

Route::post('/post-subgroup-to-group', array(
	'as' 	=> 'post-subgroup-to-group',
	'uses' 	=> 'HomeController@postSubgroupToGroup'
));

Route::post('/post-user-to-subgroup', array(
	'as' 	=> 'post-user-to-subgroup',
	'uses' 	=> 'HomeController@postUserToSubgroup'
));