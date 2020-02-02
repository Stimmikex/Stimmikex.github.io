<?php
Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/about', 'HomeController@about');
Route::get('/home', 'HomeController@index');
Route::get('/logout', 'SocialAuthController@logout');
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');
Route::get('/ride/planner', 'PlannerController@planner');

Route::group(['prefix' => 'profile'], function() {
	Route::get('/', 'ProfileController@index');
	Route::get('delete_plan', 'PlannerController@delete_plan');
	Route::get('schedule', 'PlannerController@schedule');
	Route::get('driver_info', 'PlannerController@driver_info');
	Route::get('passanger_info', 'PlannerController@passanger_info');
	Route::get('plan_info/{pid}', 'PlannerController@plan_info');
	Route::get('chat', 'ChatController@chat');

	Route::group(['prefix' => 'notifications'], function() {
		Route::get('/', 'NotificationController@notification_list');
		Route::get('/{nid}', 'NotificationController@show_notification');
	});
});

Route::group(['prefix' => 'tests'], function() {
	Route::get('carquery', function() { return view('/tests/carquery'); });
	Route::get('carapi', function() { return view('/tests/carapi'); });
});

Route::group(['prefix' => 'ride'], function() {
	Route::get('planner', 'PlannerController@planner');
	Route::get('check_plan', 'RideController@check_plan');

	Route::group(['prefix' => 'offer_ride'], function() {
		Route::get('/', 'RideController@offer_ride');
		Route::post('submit', 'RideController@offer_ride_submit');
	});

	Route::group(['prefix' => 'request_ride'], function() {
		Route::get('/', 'RideController@request_ride');
		Route::post('submit', 'RideController@request_ride_submit');
		Route::post('cancel', 'RideController@cancel_request');
	});
});

Route::post('sendmessage', 'ChatController@sendMessage');