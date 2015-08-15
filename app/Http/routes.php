<?php


Route::get('/', function () {
    return view('spa');
});

Route::group(['prefix' => 'api'], function(){

	Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);

	Route::post('authenticate', 'AuthenticateController@authenticate');

	Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');

});

/**
 * Angular Partials
 */
Route::group(['prefix' => 'angular-partials'], function(){

	Route::get('authView', function(){

		return view('angular-partials/authView');
	});

	Route::get('userView', function(){

		return view('angular-partials/userView');
	});


});
