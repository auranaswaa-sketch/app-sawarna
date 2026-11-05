<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

// Rute Dashboard Utama
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.view');

// Rute Manajemen Perangkat & Sensor Lapangan
Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
Route::get('/perangkat', [DeviceController::class, 'index'])->name('devices.perangkat');

// Rute Pengaturan Sistem & Ambang Batas Sensor
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings');

// Rute Detail Profil Admin
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
