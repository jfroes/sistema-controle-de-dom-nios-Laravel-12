<?php


use App\Http\Controllers\User\UserController;

Route::get('/', fn() => redirect()->route('dashboard'));

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::get('/users/{user}/delete', [UserController::class, 'deleteConfirmation'])->name('users.deleteConfirmation');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


Route::post('/users/{user}', [UserController::class, 'changePassword'])->name('users.changePassword');

Route::put('/users/{user}/set-status', [UserController::class, 'setUserStatus'])->name('users.status');

