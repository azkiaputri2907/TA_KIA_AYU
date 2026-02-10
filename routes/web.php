<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;


/*
|--------------------------------------------------------------------------
| PUBLIC AREA (TAMU)
|--------------------------------------------------------------------------
*/

// AJAX Search
Route::get('/cek-tamu/{nomor_induk}', [GuestController::class, 'checkVisitor']);

// Landing Page & Form
Route::get('/', [GuestController::class, 'index'])->name('landing');
Route::get('/isi-buku-tamu', [GuestController::class, 'create'])->name('guest.form');
Route::post('/simpan-tamu', [GuestController::class, 'store'])->name('guest.store');
Route::get('/berhasil/{id}', [GuestController::class, 'success'])->name('guest.success');

// Survey Tamu
Route::get('/survey/{id}', [GuestController::class, 'showSurvey'])->name('guest.survey');
Route::post('/simpan-survey', [GuestController::class, 'storeSurvey'])->name('guest.storeSurvey');


/*
|--------------------------------------------------------------------------
| AUTH AREA
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN AREA (WAJIB LOGIN + ROLE ADMIN)
|--------------------------------------------------------------------------
*/

// Pastikan Anda sudah membuat middleware 'role' atau sesuaikan kodenya jika belum
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');

    // --- MANAJEMEN KUNJUNGAN ---
    Route::get('/kunjungan', [GuestController::class, 'indexVisits'])
        ->name('visits.index');

    Route::post('/kunjungan', [GuestController::class, 'store'])
        ->name('visits.store');

    Route::put('/kunjungan/{id}', [GuestController::class, 'updateVisit'])
        ->name('visits.update');

    Route::delete('/kunjungan/{id}', [GuestController::class, 'destroyVisit'])
        ->name('visits.destroy');

    // --- MANAJEMEN SURVEY (YANG DITAMBAHKAN) ---
    Route::get('/survey', [GuestController::class, 'indexSurvey'])
        ->name('admin.survey');

    // Route Delete Survey (PENTING: Agar tombol hapus berfungsi)
    Route::delete('/survey/{id}', [GuestController::class, 'destroySurvey'])
        ->name('survey.destroy');

    // --- LAPORAN & EKSPOR (DIPERBARUI) ---
    // Ubah Controller ke LaporanController dan name ke 'admin.laporan'
    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    
    // Export PDF & Excel (Opsional: Bisa dipindahkan ke LaporanController nanti jika mau)
    Route::get('/export-pdf', [GuestController::class, 'exportPdf'])->name('admin.export.pdf');
    Route::get('/export-excel', [GuestController::class, 'exportExcel'])->name('admin.export.excel');

    // --- MANAJEMEN PENGGUNA ---
    Route::get('/pengguna', [GuestController::class, 'users'])->name('admin.users');
});


/*
|--------------------------------------------------------------------------
| KETUA AREA (WAJIB LOGIN + ROLE KETUA)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:ketua'])->prefix('ketua')->group(function () {

    Route::get('/', [DashboardController::class, 'ketua'])
        ->name('ketua.dashboardkajur');
    Route::get('/data-kunjungan', [GuestController::class, 'indexVisitsKetua'])
        ->name('ketua.data_kunjungan'); // Ganti namanya sedikit
    Route::get('/data-survey', [GuestController::class, 'indexSurveyKetua'])->name('ketua.survey.index');
    Route::get('/laporan', [LaporanController::class, 'indexKetua'])
        ->name('ketua.laporan');

});