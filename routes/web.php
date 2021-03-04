<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AnnouncementController;
use \App\Http\Controllers\Admin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', [VehicleController::class, 'index'])->name('vehicles.index');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
        Route::put('/settings/money', [UserController::class, 'addMoney'])->name('user.add.money');
        Route::get('/reservations', [UserController::class, 'reservations'])->name('user.show.reservations');
    });
    Route::group(['prefix' => 'vehicles'], function () {
        Route::get('/{id}/reserved', [VehicleController::class, 'reserved'])->name('vehicles.reserved');
        Route::post('/{vehicle}/reserved', [VehicleController::class, 'storeReserved'])->name('vehicules.reserved.store');
        Route::get('/prolonger/{id}', [VehicleController::class, 'prolonger'])->name('vehicles.prolonger');
    });

    Route::group(['prefix' => 'booking'], function () {
        Route::get('/', [VehicleController::class, 'booking'])->name('vehicles.booking');
        Route::post('/prixtcc', [VehicleController::class, 'calcul'])->name('vehicles.calcul');
    });

    Route::group(['prefix' => 'announcements'], function() {
        Route::get('/add', [AnnouncementController::class, 'add'])->name('announcement.add');
        Route::post('/', [AnnouncementController::class, 'store'])->name('announcement.store');
        Route::get('/', [AnnouncementController::class, 'list'])->name('announcement.list');
        Route::get('/edit', [AnnouncementController::class, 'edit'])->name('announcement.edit');
        Route::post('/edit/{id}', [AnnouncementController::class, 'edited'])->name('announcement.edited');
        Route::get('/delete', [AnnouncementController::class, 'delete'])->name('announcement.delete');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => [IsAdmin::class]], function () {
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles',[Admin\VehicleController::class, 'index'])->name('admin.vehicle.index');
    Route::get('/vehicles/{id}',[Admin\VehicleController::class, 'show'])->name('admin.vehicle.show');
    Route::put('/vehicles/{id}',[Admin\VehicleController::class, 'update'])->name('admin.vehicle.update');
});
