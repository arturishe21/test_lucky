<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/generate-url', \App\Http\Controllers\GenerateUrlController::class)
    ->name('generate_url');

Route::post('/feeling-lucky', [\App\Http\Controllers\TemporaryPageController::class, 'feelingLucky']);
Route::post('/get-history', [\App\Http\Controllers\TemporaryPageController::class, 'getHistory']);
Route::post('/generate-new-link', [\App\Http\Controllers\TemporaryPageController::class, 'generateNewLink']);
Route::post('/remove-link', [\App\Http\Controllers\TemporaryPageController::class, 'removeLink']);


Route::get('/temporary-url/{user}', [\App\Http\Controllers\TemporaryPageController::class, 'index'])
    ->name('temporary-url')->middleware('signed');