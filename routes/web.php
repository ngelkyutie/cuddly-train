<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostProcedureFormController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/clinic', function () { return view('clinic'); })->name('clinic');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/announcement', function () { return view('announcement'); })->name('announcement');

// --- Patient Public Auth ---
Route::get('/login', [PatientController::class, 'showLogin'])->name('login');
Route::post('/login', [PatientController::class, 'login'])->name('patient.login');
Route::post('/logout', [PatientController::class, 'logout'])->name('patient.logout');

Route::get('/register', [PatientController::class, 'showRegister'])->name('patient.register');
Route::post('/register', [PatientController::class, 'register'])->name('patient.register.submit');

// --- Patient Advanced Login / Registration ---
Route::get('/patient-login', [PatientController::class, 'showLoginForm'])->name('patient.login.form');
Route::post('/patient-login', [PatientController::class, 'loginAdvanced'])->name('patient.login.submit');
Route::post('/patient-logout', [PatientController::class, 'logoutAdvanced'])->name('patient.logout.advanced');

Route::get('/patient-registration', [PatientController::class, 'create'])->name('patient.registration');
Route::post('/patients', [PatientController::class, 'storeAdvanced'])->name('patients.store');

/*
|--------------------------------------------------------------------------
| Patient Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['patient.auth'])->prefix('patient')->group(function () {
    Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/records', [PatientController::class, 'records'])->name('patient.records');
    Route::get('/records/{id}/view', [PatientController::class, 'viewRecord'])->name('patient.records.view');
    Route::get('/records/{id}/download', [PatientController::class, 'downloadRecord'])->name('patient.records.download');
    Route::post('/medical-clearance', [PatientController::class, 'storeMedicalClearance'])->name('patient.medical-clearance.store');
});

/*
|--------------------------------------------------------------------------
| Password Change Routes
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('password.change');
    Route::put('/update-password', [AuthController::class, 'updatePassword'])->name('password.update');
    Route::get('/patient/forgot-password', [PatientController::class, 'showForgotPasswordForm'])->name('patient.password.request');

});

/*
|--------------------------------------------------------------------------
| Appointments Routes
|--------------------------------------------------------------------------
*/
Route::prefix('appointments')->group(function () {
    Route::get('/tracker', [AppointmentController::class, 'tracker'])->name('appointments.tracker');
    Route::post('/reschedule', [AppointmentController::class, 'reschedule'])->name('appointments.reschedule');
});

/*
|--------------------------------------------------------------------------
| Staff Routes
|--------------------------------------------------------------------------
*/
Route::prefix('staff')->group(function () {
    Route::get('/login', [StaffController::class, 'showLogin'])->name('staff.login');
    Route::post('/login', [StaffController::class, 'login'])->name('staff.login.submit');
    Route::post('/logout', [StaffController::class, 'logout'])->name('staff.logout');

    Route::middleware(['staff.auth'])->group(function () {
        Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
        Route::get('/schedule', [StaffController::class, 'schedule'])->name('staff.schedule');
        Route::get('/patients', [StaffController::class, 'patients'])->name('staff.patients');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/patients', [AdminController::class, 'patients'])->name('admin.patients');
        Route::get('/schedule', [AdminController::class, 'schedule'])->name('admin.schedule');
        Route::get('/procedures', [AdminController::class, 'procedures'])->name('admin.procedures');
        Route::get('/content', [AdminController::class, 'content'])->name('admin.content');

        // Content / Announcements
        Route::put('/announcement/update', [ContentController::class, 'updateAnnouncement'])->name('admin.announcement.update');
        Route::put('/mail-templates/update', [ContentController::class, 'updateMailTemplate'])->name('admin.mail-templates.update');
        Route::resource('services', ContentController::class);

        // Patient Details / History
        Route::get('/patients/{id}/info', [AdminController::class, 'viewPatientInfo'])->name('admin.patients.info');
        Route::get('/patients/{id}/edit', [AdminController::class, 'editPatientInfo'])->name('admin.patients.edit');
        Route::get('/patients/{id}/history', [AdminController::class, 'viewPatientHistory'])->name('admin.patients.history');
        Route::get('/patients/{id}/history/edit', [AdminController::class, 'editPatientHistory'])->name('admin.patients.history.edit');
        Route::put('/patients/{id}/progress-notes', [AdminController::class, 'updateProgressNotes'])->name('admin.patients.progress-notes');
        Route::delete('/patients/{id}/files', [AdminController::class, 'clearPatientFiles'])->name('admin.patients.files.clear');
        Route::delete('/patients/{id}', [AdminController::class, 'destroyPatient'])->name('admin.patients.destroy');

        // Post-procedure forms
        Route::resource('post-procedure', PostProcedureFormController::class);
        Route::get('/procedures', [PostProcedureFormController::class, 'index'])->name('admin.procedures.list');
    });
});
