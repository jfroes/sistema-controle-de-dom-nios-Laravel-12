<?php


use App\Http\Controllers\Domain;

Route::get('/domains', [Domain\DomainController::class, 'index'])->name('domains.index');
