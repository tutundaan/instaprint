<?php

Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
Route::redirect('/', '/home');
