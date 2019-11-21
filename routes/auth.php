<?php 

Route::get('home', 'PageController@home')->name('home');
Route::group(['prefix' => 'user/{user}', 'as' => 'user.'], function() {
	Route::put('block', 'UserController@block')->name('block');
	Route::patch('block', 'UserController@block')->name('block');

	Route::put('unblock', 'UserController@unblock')->name('unblock');
	Route::patch('unblock', 'UserController@unblock')->name('unblock');

	Route::put('change-password', 'UserController@changePassword')->name('change-password');
	Route::patch('change-password', 'UserController@changePassword')->name('change-password');

	Route::put('change', 'UserController@change')->name('change');
	Route::patch('change', 'UserController@change')->name('change');
});
Route::resource('user', 'UserController')->only(['index', 'store', 'update', 'destroy', 'show']);