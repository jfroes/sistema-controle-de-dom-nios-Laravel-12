<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'sendResetEmail'])->name('send-reset-email');

    Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset-password');
    Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('update-password');
});


Route::middleware(['auth', 'check_password_changed', 'check_user_status'])->group(function () {

    Route::get('/first-login', [AuthController::class, 'firstLogin'])->name('first-login');

    require __DIR__.'/auth.php';
    require __DIR__.'/user.php';
    require __DIR__ . '/domain.php';
    require __DIR__ . '/client.php';
    require __DIR__ . '/registrar.php';
    require __DIR__ . '/registrar_accounts.php';

});



