<?php

use App\Exports\ExportExcel;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Profile as AdminProfile;
use App\Livewire\Admin\Profiles as AdminProfiles;
use App\Livewire\Admin\User\Edit as AdminEditUser;
use App\Livewire\Admin\User\Add as AdminAddUser;
use App\Livewire\Admin\Vacations\VacationList as AdminVacationList;
use App\Livewire\Admin\Vacations\Edit as AdminVacationEdit;
use App\Livewire\Admin\Vacations\Create as AdminVacationCreate;
use App\Livewire\Admin\Settings\ContartType as AdminSettingsContractType;
use App\Livewire\Admin\Settings\Holiday as AdminSettingsHolidays;
use App\Livewire\Admin\Settings\FamilyStatus as AdminSettingsFamilyStatus;
use App\Livewire\Admin\Settings\ExperienceLevels as AdminSettingsExperienceLevels;
use App\Livewire\Admin\Settings\PositionType as AdminSettingsPoistionsTypes;
use App\Livewire\Admin\Settings\VacationType as AdminSettingsVacationTypes;

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\TwoFactorChallenge;
use App\Livewire\User\Dashboard as UserDashboard;
use App\Livewire\User\Profile;
use App\Livewire\User\Settings;
use App\Livewire\User\VacationRequest\Request;
use App\Livewire\User\VacationRequest\VacationsList;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Route::middleware(['layout-guest', 'auth'])->group(function () {
    Route::get('/two-factor-challenge', TwoFactorChallenge::class)->name(
        'two-factor.login'
    );
});

// THIS IS THE ROUTES FOR THE AUTHENTICATION PAGES IS ACCESSIBLE FOR GUEST WITH AUTHENTICATION WITH THE ROLE ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name(
        'Admin.Dashboard'
    );
    Route::get('/admin/profile', AdminProfile::class)->name('Admin.Profile');

    Route::get('/admin/users', AdminProfiles::class)->name('Admin.Profiles');
    Route::get('/admin/users/create', AdminAddUser::class)->name(
        'Admin.create'
    );
    Route::get('/admin/users/add/upload')->name('Admin.add.upload');
    Route::get('/admin/users/edit/{id}', AdminEditUser::class)->name(
        'Admin.edit'
    );

    Route::get('/admin/vacationRequest/list', AdminVacationList::class)->name(
        'Admin.VacationRequest.List'
    );
    Route::get(
        '/admin/vacationRequest/edit/{id}',
        AdminVacationEdit::class
    )->name('Admin.VacationRequest.Edit');
    Route::get(
        '/admin/vacationRequest/create',
        AdminVacationCreate::class
    )->name('Admin.VacationRequest.Create');

    Route::get(
        '/admin/settings/ContractType',
        AdminSettingsContractType::class
    )->name('Admin.Settings.ContractType');
    Route::get('/admin/settings/holidays', AdminSettingsHolidays::class)->name(
        'Admin.Settings.Holidays'
    );
    Route::get(
        '/admin/settings/familyStatus',
        AdminSettingsFamilyStatus::class
    )->name('Admin.Settings.FamilyStatus');
    Route::get(
        '/admin/settings/experienceLevels',
        AdminSettingsExperienceLevels::class
    )->name('Admin.Settings.ExperienceLevels');
    Route::get(
        '/admin/settings/positionTypes',
        AdminSettingsPoistionsTypes::class
    )->name('Admin.Settings.PositionsTypes');
    Route::get(
        '/admin/settings/vacationTypes',
        AdminSettingsVacationTypes::class
    )->name('Admin.Settings.VacationTypes');

    // Import and export route
    // This for export data
    Route::post('/admin/export/users', [
        ExportController::class,
        'ExportUsers',
    ]);
    // This for import data to database
    Route::post('/admin/import/users', [
        ExportController::class,
        'ImportUsers',
    ]);

    // this for logout from the account
    Route::post('/logout', [AuthController::class, 'Logout'])->name(
        'Auth.Logout'
    );
});

// THIS IS THE ROUTES FOR THE AUTHENTICATION PAGES IS ACCESSIBLE FOR GUEST WITH AUTHENTICATION WITH THE ROLE USER
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user-dashboard', UserDashboard::class)->name('User.Dashboard');
    Route::get('/profile', Profile::class)->name('User.Profile');
    Route::get('/settings', Settings::class)->name('User.Settings');

    Route::get('/vacationRequest/list', VacationsList::class)->name(
        'User.VacationRequest.List'
    );
    Route::get('/vacationRequest/request', Request::class)->name(
        'User.VacationRequest.Request'
    );
    Route::post('/logout', [AuthController::class, 'Logout'])->name(
        'Auth.Logout'
    );
});

//call artisan console commands
Route::get('call-artisan', function () {
    $exitCode = Artisan::call('migrate:fresh');
    echo 'Database migrated: ' . $exitCode . '<br>';
    $exitCode = Artisan::call('db:seed');
    echo 'Database seeded: ' . $exitCode . '<br>';
    $exitCode = Artisan::call('optimize');
    echo 'Optimized: ' . $exitCode . '<br>';
    $exitCode = Artisan::call('optimize:clear');
    echo 'Optimize cleared: ' . $exitCode . '<br>';
    $exitCode = Artisan::call('storage:link');
    echo 'Storage Linked: ' . $exitCode . '<br>';
});
