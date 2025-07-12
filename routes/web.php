<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Livewire\AuthUser;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('auth', [AuthController::class, 'index'])->name('auth')->middleware('guest');
