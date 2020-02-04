<?php

Auth::routes(['register' => false]);
Route::redirect('/', 'auth/home');