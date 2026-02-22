<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Dashboard Overview
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Production Scheduling Routes
Route::prefix('schedules')->name('schedules.')->group(function () {
    Route::get('/', [ScheduleController::class, 'index'])->name('index');
    Route::post('/', [ScheduleController::class, 'store'])->name('store');
    
    // Patch route khusus untuk logika Balancing & Actual Output
    Route::patch('/{id}/actual', [ScheduleController::class, 'updateActual'])->name('updateActual');
});

// Master Data Lines
Route::resource('lines', LineController::class)->except(['create', 'edit', 'show']);

// Master Data Orders
Route::resource('orders', OrderController::class)->except(['create', 'edit', 'show']);