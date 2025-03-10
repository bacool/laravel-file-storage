<?php
use App\Http\Controllers\FileController;

Route::get('/', [FileController::class, 'index']);
Route::post('/upload', [FileController::class, 'upload'])->name('upload');
Route::delete('/delete/{id}', [FileController::class, 'delete'])->name('delete');
