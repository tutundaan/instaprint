<?php

Route::group(['prefix' => 'employee/{employee}'], function () {
    Route::resource('failure', 'FailureController')->only(['store']);
});
Route::resource('employee', 'EmployeeController')->only(['index']);