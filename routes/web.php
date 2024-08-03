<?php

use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\User\Dashboard as UserDashboard;
use App\Livewire\User\Profile;
use App\Livewire\User\VacationRequest\Request;
use App\Livewire\User\VacationRequest\VacationsList;
use Illuminate\Support\Facades\Route;

// THIS IS THE ROUTES FOR THE AUTHENTICATION PAGES IS ACCESSIBLE FOR GUEST WITHOUT AUTHENTICATION
Route::middleware(['layout-guest', 'guest'])->group(function () {
    Route::get('/', Login::class)->name('Auth.Login');
    // This for the resest from the password form
    Route::get('/forgot-password', ForgotPassword::class)->name(
        'Auth.ForgotPassword]'
    );
    // This for the reset password form with token
    Route::get('/reset-password/{token}', ResetPassword::class)->name(
        'Auth.ResetPassword'
    );
});

// THIS IS THE ROUTES FOR THE AUTHENTICATION PAGES IS ACCESSIBLE FOR GUEST WITH AUTHENTICATION WITH THE ROLE ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('Admin.Dashboard');
});

// THIS IS THE ROUTES FOR THE AUTHENTICATION PAGES IS ACCESSIBLE FOR GUEST WITH AUTHENTICATION WITH THE ROLE USER
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user-dashboard', UserDashboard::class)->name('User.Dashboard');
    Route::get('/profile', Profile::class)->name('User.Profile');
    Route::get('/vacationRequest/list', VacationsList::class)->name(
        'User.VacationRequest.List'
    );
    Route::get('/vacationRequest/request',Request::class)->name('User.VacationRequest.Request');
});
