<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\AdminController;


use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuthenticatedSessiionController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController as AdminPasswordResetLinkController;

use App\Http\Controllers\User\UserController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // -----------GUEST ROUTE FOR USER START-----------
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    // -----------GUEST ROUTE FOR USER END-----------

});

Route::prefix('/user')->name('user.')->group(function (){
    Route::middleware('auth')->group(function () {
        Route::get('dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::post('profile/update', [UserController::class, 'profile_update'])->name('profile.update');
        Route::post('password/update', [UserController::class, 'password_update'])->name('password.update');
        Route::get('message-history', [UserController::class, 'message_history'])->name('message-history');

        Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});

/*===================Admin Panel Routes Start===================*/
Route::prefix('/admin')->name('admin.')->group(function (){

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthenticatedSessiionController::class, 'create'])->name('login');
        Route::post('login', [AdminAuthenticatedSessiionController::class, 'store']);
    });



    Route::middleware('admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('profile/update', [AdminController::class, 'profile_update'])->name('profile.update');
        Route::post('password/update', [AdminController::class, 'password_update'])->name('password.update');
        Route::post('change-algorithm', [AdminController::class, 'change_algorithm'])->name('change-algorithm');

        Route::resource('training', TrainingController::class);
        Route::get('training/status-change/{id}',[TrainingController::class, 'status_change'])->name('training.status-change');
        Route::get('system-training',[TrainingController::class, 'train'])->name('system-training');

        Route::post('logout', [AdminAuthenticatedSessiionController::class, 'destroy'])->name('logout');
    });
});
/*===================Admin Panel Routes End===================*/

/*===================Super Admin Panel Routes Start===================*/
Route::prefix('/superadmin')->name('superadmin.')->group(function (){

    Route::middleware('guest:superadmin')->group(function () {
        Route::get('/login', [AdminAuthenticatedSessiionController::class, 'create'])->name('login');
        Route::post('login', [AdminAuthenticatedSessiionController::class, 'store']);
    });


    Route::middleware('superadmin')->group(function () {

        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('profile/update', [AdminController::class, 'profile_update'])->name('profile.update');
        Route::post('password/update', [AdminController::class, 'password_update'])->name('password.update');
        Route::post('change-algorithm', [AdminController::class, 'change_algorithm'])->name('change-algorithm');

        Route::resource('training', TrainingController::class);
        Route::get('training/status-change/{id}',[TrainingController::class, 'status_change'])->name('training.status-change');
        Route::get('system-training',[TrainingController::class, 'train'])->name('system-training');

        Route::post('logout', [AdminAuthenticatedSessiionController::class, 'destroy'])->name('logout');
    });
});
/*===================Super Admin Panel Routes End===================*/
