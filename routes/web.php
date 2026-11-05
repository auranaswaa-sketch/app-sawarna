<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.view');
Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
Route::get('/perangkat', [DeviceController::class, 'index'])->name('devices.perangkat');
