<?php

Route::get('test', function() {
    return view('layouts.main');
});
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
Route::redirect('/', '/home');
