<?php

use App\Http\Controllers\Admin\AdminChangePasswordController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDeleteAccountController;
use App\Http\Controllers\Admin\AdminUpdateController;
use App\Http\Controllers\Admin\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('custom.admin_panel_prefix'))->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::redirect('/', config('custom.admin_panel_prefix') . '/dashboard');

        Route::get('dashboard', DashboardController::class)->name('dashboard');

        Route::get('change_password', [AdminChangePasswordController::class, 'index'])->name('change_password');
        Route::post('change_password', [AdminChangePasswordController::class, 'store']);

        Route::get('admin_update', [AdminUpdateController::class, 'index'])->name('admin_update');
        Route::post('admin_update', [AdminUpdateController::class, 'store']);
        Route::delete('admin_update', [AdminUpdateController::class, 'deleteAvatar']);

        Route::get('delete_account', [AdminDeleteAccountController::class, 'index'])->name('delete_account');
        Route::delete('delete_account', [AdminDeleteAccountController::class, 'destroy']);

        Route::resource('admins', AdminController::class);

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});
