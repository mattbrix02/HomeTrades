<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;




Route::get('/', [IndexController::class, 'index'])->name('index.index');
Route::get('/show', [IndexController::class, 'show'])->name('index.show');


// Course Resource Routes (CRUD)
Route::resource('courses', CourseController::class)->only(['create', 'store', 'edit', 'update', 'destroy'])->middleware('auth');
Route::resource('courses', CourseController::class)->only(['index', 'show']);


// Project Resource Routes (CRUD)
Route::resource('projects', ProjectController::class)->only(['create', 'store', 'edit', 'update', 'destroy'])->middleware('auth');
Route::resource('projects', ProjectController::class)->only(['index', 'show']);

    //For project+course
    Route::get('/projects/{project}/courses/create', [CourseController::class, 'createFromProject'])
        ->name('projects.courses.create');

    //Auth & Login
Route::get('/login', [AuthController::class, 'create'])->name('login')->middleware('guest');
Route::resource('auth', AuthController::class);

Route::delete('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('auth.destroy');

Route::get('/admin', [AuthController::class, 'admin'])->middleware('auth')->name('auth.admin');




//Registration
Route::resource('register', RegistrationController::class);

require __DIR__ . '/tiptap.php';

