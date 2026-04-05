<?php


use App\Http\Controllers\Registrar\RegistrarController;

Route::resource('registrars', RegistrarController::class);

Route::get('registrars/confirm_delete/{registrar}', [RegistrarController::class, 'confirm_delete'])->name('registrars.confirm_delete');
