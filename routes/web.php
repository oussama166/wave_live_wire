<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', Login::class)->name('Auth.Login');
    // This for the resest from the password form
    Route::get('/forgot-password', ForgotPassword::class)->name(
        'Auth.ForgotPassword'
    );
    Route::get('/reset-password/{token}', ResetPassword::class)->name(
        'Auth.ResetPassword'
    );
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('Admin.Dashboard');
});
