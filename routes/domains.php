<?php


use App\Http\Controllers\Domain\DomainController;

Route::get('/domains', [DomainController::class, 'index'])->name('domains.index');

Route::get('/domains/{domain}', [DomainController::class, 'show'])->name('domains.show');
