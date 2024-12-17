<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::controller(AuthController::class)->group(function() {
        Route::post('/login', 'login')->name('auth.request.login');
    });

    Route::controller(PageController::class)->group(function() {
        Route::get('/login', 'login')->name('auth.pages.login');
    });
});

Route::controller(PageController::class)->group(function() {
    Route::fallback('notFound');
});

Route::middleware('auth:Approver')->group(function() {
    Route::controller(ApprovalController::class)->prefix('/approvals')->group(function() {
        Route::put('/reservation/{reservation}', 'update')->name('approvals.request.update');
    });

    Route::controller(ReservationController::class)->prefix('/reservations')->group(function() {

    });
});

Route::middleware('auth:Admin')->group(function() {
    Route::controller(ReservationController::class)->prefix('/reservations')->group(function() {

        Route::get('/create', 'create')->name('reservations.pages.create');
        Route::get('/edit/{reservation}', 'edit')->name('reservations.pages.edit');

        Route::post('', 'store')->name('reservations.request.store');
        Route::put('/{reservation}', 'update')->name('reservations.request.update');

        Route::get('/finish/{reservation}', 'finish')->name('reservations.pages.finish');
    });
});


Route::middleware('auth')->group(function () {
    Route::controller(PageController::class)->group(function() {
        Route::get('/', function() {
            return redirect(route('dashboard'));
        });
        Route::get('/dashboard', 'dashboard')->name('dashboard');

        Route::get('/logs', 'log')->name('logs.pages.index');
    });

    Route::controller(AuthController::class)->group(function() {
        Route::delete('/logout', 'logout')->name('auth.request.logout');
    });

    Route::controller(ReservationController::class)->prefix('/reservations')->group(function() {
        Route::get('', 'index')->name('reservations.pages.index');
        Route::get('/show/{reservation}', 'show')->name('reservations.pages.show');
        Route::get('/export/excel', 'exportExcel')->name('reservations.request.export.excel');
    });

    Route::controller(DriverController::class)->prefix('/drivers')->group(function() {
        Route::get('/', 'index')->name('drivers.pages.index');
        Route::get('/create', 'create')->name('drivers.pages.create');
        Route::post('/', 'store')->name('drivers.store');
        Route::get('/{driver}/edit', 'edit')->name('drivers.pages.edit');
        Route::put('/{driver}', 'update')->name('drivers.update');
        Route::delete('/{driver}', 'destroy')->name('drivers.destroy');
    });

    Route::controller(UserController::class)->prefix('/users')->group(function() {
        Route::get('', 'index')->name('users.pages.index');
    });

    Route::controller(LogController::class)->prefix('/logs')->group(function() {
        Route::get('', 'index')->name('logs.pages.index');
    });

    Route::controller(VehicleController::class)->prefix('/vehicles')->group(function() {
        Route::get('', 'index')->name('vehicles.pages.index');
        Route::get('/create', 'create')->name('vehicles.pages.create');
        Route::get('/edit/{vehicle}', 'edit')->name('vehicles.pages.edit');
        Route::get('/show/{vehicle}', 'show')->name('vehicles.pages.show');
        Route::post('', 'store')->name('vehicles.request.store');
        Route::put('/{vehicle}', 'update')->name('vehicles.request.update');
    });
});

