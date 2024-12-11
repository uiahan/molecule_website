<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ToastController;
use App\Http\Controllers\UserController;
use App\Models\Registration;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

Route::get('/', [InvitationController::class, 'invitation'])->name('invitation');
Route::get('/success', [InvitationController::class, 'success'])->name('success');
Route::post('/postAddInvitation', [InvitationController::class, 'postAddInvitation'])->name('postAddInvitation');
Route::post('/attendance/update/{id}', [ToastController::class, 'update'])->name('attendance.update');

Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/postLogin', [LoginController::class, 'postLogin'])->name('postLogin');
    Route::middleware('auth')->group(function () {
        Route::get('/registration', [RegistrationController::class, 'registration'])->name('registration');
        Route::get('/editRegistration/{id}', [RegistrationController::class, 'editRegistration'])->name('editRegistration');
        Route::post('/postEditRegistration/{id}', [RegistrationController::class, 'postEditRegistration'])->name('postEditRegistration');
        Route::get('/downloadQrCode/{id}', [RegistrationController::class, 'downloadQrCode'])->name('downloadQrCode');
        Route::get('/delete/{id}', [RegistrationController::class, 'delete'])->name('delete');
        Route::get('/setHadir/{id}', [RegistrationController::class, 'setHadir'])->name('setHadir');
        Route::get('/setTidakHadir/{id}', [RegistrationController::class, 'setTidakHadir'])->name('setTidakHadir');
        Route::get('/chart', [ChartController::class, 'chart'])->name('chart');
        Route::post('/registrations/bulk-send-emails', [RegistrationController::class, 'bulkSendQrEmails'])->name('registrations.bulk-send-emails');
        Route::get('/send-qr-whatsapp/{id}', [RegistrationController::class, 'sendQrToWhatsApp'])->name('sendQrToWhatsApp');
        Route::post('/registrations/bulk-send-whatsapp', [RegistrationController::class, 'bulkSendQrToWhatsApp'])->name('registrations.bulk-send-whatsapp');
        Route::post('/registrations/bulk-delete', [RegistrationController::class, 'bulkDelete'])->name('registrations.bulk-delete');
        Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('changePassword');
        Route::get('/showChangePassword', [ChangePasswordController::class, 'showChangePassword'])->name('showChangePassword');
        Route::get('/registrations/export', [ExportController::class, 'exportExcel'])->name('registrations.export');

        Route::get('/user', [UserController::class, 'user'])->name('user');
        Route::get('/logo', [LogoController::class, 'logo'])->name('logo');
        Route::post('/logoEdit/{id}', [LogoController::class, 'logoEdit'])->name('logoEdit');
        Route::get('/tambahUser', [UserController::class, 'tambahUser'])->name('tambahUser');
        Route::get('/editUser/{id}', [UserController::class, 'editUser'])->name('editUser');
        Route::get('/adminresetpw/{id}', [UserController::class, 'resetpw'])->name('resetpw');
        Route::post('/postTambahUser', [UserController::class, 'postTambahUser'])->name('postTambahUser');
        Route::get('/postHapusUser/{id}', [UserController::class, 'postHapusUser'])->name('postHapusUser');
        Route::post('/postEditUser/{id}', [UserController::class, 'postEditUser'])->name('postEditUser');
        Route::post('/postResetPassword/{id}', [UserController::class, 'postResetPassword'])->name('postResetPassword');
    });
});

