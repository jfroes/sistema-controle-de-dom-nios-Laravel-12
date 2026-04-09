<?php


use App\Http\Controllers\RegistrarAccount\RegistrarAccountController;

Route::resource('registrar_accounts', RegistrarAccountController::class);

Route::get('registrar_accounts/confirm_delete/{registrar_account}', [RegistrarAccountController::class, 'confirm_delete'])->name('registrar_accounts.confirm_delete');
