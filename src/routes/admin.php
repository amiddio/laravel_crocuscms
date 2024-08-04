<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/login', LoginController::class)->name('login');

});
