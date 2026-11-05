<?php

use App\Http\Controllers\DashboardController;
<<<<<<< HEAD
use App\Http\Controllers\DeviceController;
=======
use App\Http\Controllers\SettingController;
>>>>>>> 9e5256f0474dc287630a80075c0ad1c715460d8e
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.view');
<<<<<<< HEAD
Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
Route::get('/perangkat', [DeviceController::class, 'index'])->name('devices.perangkat');
=======

// Rute Pengaturan Admin
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings');
>>>>>>> 9e5256f0474dc287630a80075c0ad1c715460d8e
