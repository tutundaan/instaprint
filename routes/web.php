<?php

Auth::routes(['register' => false]);
Route::redirect('/', 'auth/home');

Route::resource('rank', 'Api\RankController')->only(['index']);
