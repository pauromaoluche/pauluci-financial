<?php

use App\Http\Middleware\AuthenticationMiddleware;
use App\Livewire\Dashboard;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth\AuthUser as AuthAuthUser;
use App\Livewire\Auth\VerifyEmailNotice;
use App\Livewire\Transaction\Deposit;
use App\Livewire\Transaction\Transfer;

Route::get('/', Home::class)->name('index');

Route::get('auth', AuthAuthUser::class)->name('auth')->middleware('guest');

Route::get('/email/verify', VerifyEmailNotice::class)
    ->middleware([AuthenticationMiddleware::class])
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware([AuthenticationMiddleware::class, 'signed', 'throttle:6,1'])
    ->name('verification.verify');


Route::middleware([AuthenticationMiddleware::class, 'verified'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', Dashboard::class)->name('index');
        Route::get('/depositar', Deposit::class)->name('deposit');
        Route::get('/transferir', Transfer::class)->name('transfer');
    });
});
