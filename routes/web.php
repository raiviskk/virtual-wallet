<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/wallets', [WalletsController::class, 'index'])->name('wallets.index');
    Route::get('/wallets/create', [WalletsController::class, 'create'])->name('wallets.create');
    Route::get('/wallets/{wallet}', [WalletsController::class,'show'])->name('wallets.show');
    Route::post('/wallets', [WalletsController::class, 'store'])->name('wallets.store');
    Route::get('/wallets/{wallet}/edit', [WalletsController::class, 'edit'])->name('wallets.edit');
    Route::put('/wallets/{wallet}', [WalletsController::class, 'update'])->name('wallets.update');
    Route::delete('/wallets/{wallet}', [WalletsController::class, 'destroy'])->name('wallets.destroy');
    Route::get('/transaction', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
    Route::delete('/transaction/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::post('/transactions/{transaction}/mark-as-fraudulent', [TransactionController::class, 'markAsFraudulent'])->name('transactions.markAsFraudulent');

});

require __DIR__.'/auth.php';
