<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/', DashboardController::class)
            ->middleware(['permission:dashboard'])
            ->name('dashboard');


    });

    Route::prefix('wallets')->as('wallets.')->middleware(['permission:wallets'])->group(function () {})
        ->group(function () {
            Route::get('/', [WalletController::class, 'index'])->name('index');
            Route::get('/create', [WalletController::class, 'create'])->name('create');
            Route::post('/', [WalletController::class, 'store'])->name('store');
//            Route::get('/{wallet}/edit', [WalletController::class, 'edit'])->name('edit');
            Route::patch('/{wallet}', [WalletController::class, 'update'])->name('update');

            Route::prefix('{wallet}/transactions')->as('transactions.')->group(function () {
                Route::get('/', [TransactionController::class, 'index'])->name('index');
                Route::post('/deposit', [TransactionController::class, 'deposit'])->name('deposit');
                Route::post('/withdraw', [TransactionController::class, 'withdraw'])->name('withdraw');
            });
        });

});
