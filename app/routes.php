<?php


Route::get('/', array(
	'as' 	=> 'home', 
	'uses'  => 'HomeController@getHome'
));

Route::get('/user/{user}', array(
	'as' 	=> 'user', 
	'uses'  => 'HomeController@getUser'
));

Route::get('/group/{group}', array(
	'as' 	=> 'group', 
	'uses'  => 'HomeController@getGroup'
));

Route::get('/event/{event}', array(
	'as' 	=> 'event', 
	'uses'  => 'HomeController@getEvent'
));

// ------------------------------ //

Route::post('/post-event', array(
	'as' 	=> 'post-event',
	'uses' 	=> 'HomeController@postEvent'
));

Route::get('/delete-event/{id}', array(
	'as' 	=> 'delete-event',
	'uses' 	=> 'HomeController@deleteEvent'
));

Route::post('/post-group', array(
	'as' 	=> 'post-group',
	'uses' 	=> 'HomeController@postGroup'
));

Route::post('/detach-group', array(
	'as' 	=> 'detach-group',
	'uses' 	=> 'HomeController@detachGroup'
));

Route::get('/delete-group/{id}', array(
	'as' 	=> 'delete-group',
	'uses' 	=> 'HomeController@deleteGroup'
));

Route::post('/post-subgroup', array(
	'as' 	=> 'post-subgroup',
	'uses' 	=> 'HomeController@postSubgroup'
));

Route::post('/detach-subgroup', array(
	'as' 	=> 'detach-subgroup',
	'uses' 	=> 'HomeController@detachSubgroup'
));

Route::get('/delete-subgroup/{id}', array(
	'as' 	=> 'delete-subgroup',
	'uses' 	=> 'HomeController@deleteSubgroup'
));

Route::post('/post-user', array(
	'as' 	=> 'post-user',
	'uses' 	=> 'HomeController@postUser'
));

Route::post('/detach-user', array(
	'as' 	=> 'detach-user',
	'uses' 	=> 'HomeController@detachUser'
));

Route::get('/delete-user/{id}', array(
	'as' 	=> 'delete-user',
	'uses' 	=> 'HomeController@deleteUser'
));

// --------------------------------------- //

Route::post('/post-group-to-event', array(
	'as' 	=> 'post-group-to-event',
	'uses' 	=> 'HomeController@postGroupToEvent'
));

Route::post('/post-subgroup-to-event', array(
	'as' 	=> 'post-subgroup-to-event',
	'uses' 	=> 'HomeController@postSubgroupToEvent'
));

Route::post('/post-subgroup-to-group', array(
	'as' 	=> 'post-subgroup-to-group',
	'uses' 	=> 'HomeController@postSubgroupToGroup'
));

Route::post('/post-user-to-subgroup', array(
	'as' 	=> 'post-user-to-subgroup',
	'uses' 	=> 'HomeController@postUserToSubgroup'
));

// --------------------------------------- //

Route::get('/confirm/{event_id}/{user_id}/{subgroup_id}', array(
	'as' 	=> 'confirm',
	'uses' 	=> 'HomeController@setStatusTrue'
));

Route::get('/deny/{event_id}/{user_id}/{subgroup_id}', array(
	'as' 	=> 'deny',
	'uses' 	=> 'HomeController@setStatusFalse'
));