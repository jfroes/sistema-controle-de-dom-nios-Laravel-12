<?php


use App\Http\Controllers\Auth\AuthController;



Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::post('/password/change', [AuthController::class, 'passwordChange'])->name('password.change');
