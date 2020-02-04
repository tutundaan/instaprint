<?php

Route::group(['prefix' => 'employee/{employee}'], function () {
    Route::resource('attendance', 'AttendanceController')->only(['store']);
    Route::resource('failure', 'FailureController')->only(['store']);
});

Route::resource('employee', 'EmployeeController')->only(['index']);
Route::resource('rank', 'RankController')->only(['index']);