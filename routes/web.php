<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index.index');
Route::get('/show', [IndexController::class, 'show'])->name('index.show');

// Course Resource Routes (CRUD)
Route::resource('courses', CourseController::class);
