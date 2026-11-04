<?php

use App\Http\Controllers\Administrator\PermissionController;
use App\Http\Controllers\Administrator\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| The parts of the application rewritten for Laravel. Everything else is still in
| routes/legacy.php, which loads after this file.
|
*/

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->middleware('throttle:10,1');

    Route::get('forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'store'])->middleware('throttle:5,1')->name('password.email');
    Route::get('reset-password/{token}', [PasswordResetController::class, 'edit'])->name('password.reset');
    Route::post('reset-password', [PasswordResetController::class, 'update'])->middleware('throttle:5,1')->name('password.update');
});

Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::prefix('administrator')->middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('roles', [RoleController::class, 'index'])->middleware('permission:administrator.role.view')->name('roles.index');
    Route::post('roles', [RoleController::class, 'store'])->middleware('permission:administrator.role.add')->name('roles.store');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->middleware('permission:administrator.role.edit')->name('roles.edit');
    Route::put('roles/{role}', [RoleController::class, 'update'])->middleware('permission:administrator.role.edit')->name('roles.update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->middleware('permission:administrator.role.delete')->name('roles.destroy');

    Route::middleware('permission:administrator.permission.edit')->group(function () {
        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('permissions/{role}', [PermissionController::class, 'show'])->name('permissions.show');
        Route::put('permissions/{role}', [PermissionController::class, 'update'])->name('permissions.update');
    });
});

// Old addresses, for bookmarks and links in emails already sent.
Route::redirect('auth/login', '/login');
Route::redirect('auth/forgot', '/forgot-password');
Route::redirect('administrator/role/index', '/administrator/roles');
Route::redirect('administrator/permission/index', '/administrator/permissions');
