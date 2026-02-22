<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sewing Schedule Management System
|--------------------------------------------------------------------------
*/

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Production Schedules
Route::prefix('schedules')->name('schedules.')->group(function () {
    Route::get('/', [ScheduleController::class, 'index'])->name('index');
    Route::post('/', [ScheduleController::class, 'store'])->name('store');
    Route::put('/{id}', [ScheduleController::class, 'update'])->name('update');
    Route::delete('/{id}', [ScheduleController::class, 'destroy'])->name('destroy');
    
    // Custom route untuk balancing output
    Route::patch('/{id}/actual', [ScheduleController::class, 'updateActual'])->name('updateActual');
});

// Master Data: Lines
Route::resource('lines', LineController::class)->except([
    'create', 'edit', 'show'
]);

// Master Data: Orders
Route::resource('orders', OrderController::class)->except([
    'create', 'edit', 'show'
]);