<?php

use App\Http\Controllers\TiptapUploadController;
use Illuminate\Support\Facades\Route;

Route::post('/tiptap/upload', [TiptapUploadController::class, 'upload'])
    ->middleware('auth')
    ->name('tiptap.upload');

