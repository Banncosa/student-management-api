<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//routes for students

Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::post('/students', [StudentController::class, 'add']);
Route::patch('/students/{id}', [StudentController::class, 'update']);

//routes for subs

Route::get('/students/{id}/subjects', [SubjectController::class, 'index']);
Route::post('/students/{id}/subjects', [SubjectController::class, 'add']);
Route::get('/students/{id}/subjects/{subject_id}', [SubjectController::class, 'show']);
Route::patch('/students/{id}/subjects/{subject_id}', [SubjectController::class, 'update']);