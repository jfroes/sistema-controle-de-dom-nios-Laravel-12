<?php


use App\Http\Controllers\Domain\DomainController;

Route::get('/domains', [DomainController::class, 'index'])->name('domains.index');

Route::get('/domains/create', [DomainController::class, 'create'])->name('domains.create');
Route::post('/domains', [DomainController::class, 'store'])->name('domains.store');

Route::get('/domains/{domain}/edit', [DomainController::class, 'edit'])->name('domains.edit');
Route::put('/domains/{domain}', [DomainController::class, 'update'])->name('domains.update');

Route::get('/domains/{domain}/delete', [DomainController::class, 'deleteConfirmation'])->name('domains.deleteConfirmation');
Route::delete('/domains/{domain}', [DomainController::class, 'destroy'])->name('domains.destroy');

Route::get('/domains/{domain}', [DomainController::class, 'show'])->name('domains.show');
