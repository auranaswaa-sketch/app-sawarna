<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.view');

// Rute Perangkat dan Sensor Lapangan
Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
Route::get('/perangkat', [DeviceController::class, 'index'])->name('devices.perangkat');

// Rute Grafik Tren dan Riwayat Cuaca
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
Route::get('/grafik', [AnalyticsController::class, 'index'])->name('analytics.grafik');
Route::get('/riwayat', [AnalyticsController::class, 'index'])->name('analytics.riwayat');
Route::get('/analytics/export', [AnalyticsController::class, 'exportCsv'])->name('analytics.export');

// Rute Pengaturan Admin
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings');
