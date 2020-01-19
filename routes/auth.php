<?php 

Route::post('employee/{employee}/failure', 'EmployeeController@link')->name('employee.link');
Route::delete('failure/{failure}/unlink', 'FailureController@unlink')->name('failure.unlink');
Route::patch('failure/{failure}/relink', 'FailureController@relink')->name('failure.relink');
Route::put('failure/{failure}/relink', 'FailureController@relink')->name('failure.relink');
Route::post('failure/{failure}/link', 'FailureController@link')->name('failure.link');
Route::resource('failure', 'FailureController')->only(['index', 'store']);
Route::resource('employee', 'EmployeeController')->only(['index', 'update', 'destroy']);
Route::resource('link-account', 'LinkAccountController')->only(['index', 'store', 'destroy', 'update']);
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
Route::group(['prefix' => 'user'], function() {
    Route::resource('role', 'RoleController')->only(['index']);
});
Route::post('user/link', 'UserController@link')->name('user.link');
Route::resource('user', 'UserController')->only(['index', 'store', 'update', 'destroy', 'show']);
Route::resource('monthly-attendance', 'MonthlyAttendanceController')->only(['index', 'create', 'store', 'show']);
