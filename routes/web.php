<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;


route::get('/', [IndexController::class, 'index']);
route::get('/hello', [IndexController::class, 'show'])->middleware('auth');

Route::resource('listings', ListingController::class)
->only('create','store','edit','update', 'destroy')->middleware('auth');
Route::resource('listings', ListingController::class)
->except('create','store','edit','update', 'destroy');

Route::get('login', [AuthController::class, 'create'])->name('login');

Route::post('login', [AuthController::class, 'store'])->name('login.store');

Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');
