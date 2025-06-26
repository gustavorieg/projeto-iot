<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemperaturaController;

Route::resource('device', 'App\Http\Controllers\DeviceController');
Route::get('/', [TemperaturaController::class, 'index']);
Route::get('/temperaturas/dados', [TemperaturaController::class, 'dados']); // AJAX