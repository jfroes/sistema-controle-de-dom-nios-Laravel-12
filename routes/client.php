<?php


use App\Http\Controllers\Client\ClientController;

Route::resource('clients', ClientController::class);

Route::get('clients/confirm_delete/{client}', [ClientController::class, 'confirm_delete'])->name('clients.confirm_delete');
