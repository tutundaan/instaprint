<?php 

Route::group(['prefix' => 'user/{user}', 'as' => 'user.'], function() {
	Route::put('block', 'UserController@block')->name('block');
	Route::patch('block', 'UserController@block')->name('block');

	Route::put('unblock', 'UserController@unblock')->name('unblock');
	Route::patch('unblock', 'UserController@unblock')->name('unblock');
});
Route::resource('user', 'UserController')->only(['index', 'store', 'update', 'destroy']);