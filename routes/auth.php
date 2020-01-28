<?php 

Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

Route::group(['prefix' => 'employee/{employee}'], function() {
    Route::group(['prefix' => 'recomendation/{recomendation}'], function() {
        Route::put('reject', 'RecomendationController@reject')->name('recomendation.reject');
        Route::patch('reject', 'RecomendationController@reject')->name('recomendation.reject');

        Route::put('accept', 'RecomendationController@accept')->name('recomendation.accept');
        Route::patch('accept', 'RecomendationController@accept')->name('recomendation.accept');
    });

    Route::resource('recomendation', 'RecomendationController')->only(['store', 'destroy']);
    Route::post('failure', 'EmployeeController@link')->name('employee.link');
});

Route::resource('rating', 'RatingController')->only(['index', 'store', 'show']);

Route::group(['prefix' => 'failure/{failure}'], function() {
    Route::delete('unlink', 'FailureController@unlink')->name('failure.unlink');
    Route::patch('relink', 'FailureController@relink')->name('failure.relink');
    Route::put('relink', 'FailureController@relink')->name('failure.relink');
    Route::post('link', 'FailureController@link')->name('failure.link');
});

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
    Route::post('link', 'UserController@link')->name('user.link');
});

Route::resource('user', 'UserController')->only(['index', 'store', 'update', 'destroy', 'show']);
Route::resource('monthly-attendance', 'MonthlyAttendanceController')->only(['index', 'create', 'store', 'show']);
