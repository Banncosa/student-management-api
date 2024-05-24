<?php
<<<<<<< HEAD
use App\Http\Controllers\StudentController;

require __DIR__.'/api.php';
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
=======

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
>>>>>>> origin/master
