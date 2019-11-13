<?php 

Route::resource('user', 'UserController')->only(['index', 'store', 'update', 'destroy']);