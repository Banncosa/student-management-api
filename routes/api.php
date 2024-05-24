<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
Route::patch('/students/{id}', [StudentController::class, 'update'])->name('students.update');
Route::get('/students/{id}/subjects', [StudentSubjectController::class, 'index']);
Route::post('/students/{id}/subjects', [StudentSubjectController::class, 'store']);
Route::get('/students/{id}/subjects/{subject_id}', [StudentSubjectController::class, 'show']);
Route::patch('/students/{id}/subjects/{subject_id}', [StudentSubjectController::class, 'update']);
