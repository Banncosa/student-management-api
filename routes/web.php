<?php
use App\Http\Controllers\StudentController;

require __DIR__.'/api.php';
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
