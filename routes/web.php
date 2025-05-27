<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    EventMemberController,
    MemberPaymentController,
    PanitiaScanController,
    PanitiaCertificateController,
    MemberCertificateController,
    AdminUserController,
    MemberQrController,
    ProfileController
};

// 🌐 Redirect Root: guest ke login, user ke dashboard universal
Route::get('/', fn() => redirect()->guest('login'))->middleware('guest');
Route::get('/', fn() => redirect()->route('dashboard'))->middleware('auth');

// 🧭 Universal Redirector ke dashboard per role
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// 👑 Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.admin'))->name('dashboard');
    Route::resource('users', AdminUserController::class)->except(['show']);
});

// 👤 Member Routes
Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.member'))->name('dashboard');
    Route::get('/events/{event}/register', [EventMemberController::class, 'register'])->name('events.register');
    Route::get('/payments/{registration}/create', [MemberPaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/{registration}', [MemberPaymentController::class, 'store'])->name('payments.store');
    Route::get('/certificates/{registration}/download', [MemberCertificateController::class, 'download'])
    ->middleware(['auth', 'role:member'])
    ->name('certificates.download');
    Route::get('/certificates', [MemberCertificateController::class, 'show'])
    ->middleware(['auth', 'role:member'])
    ->name('certificates.show');
    Route::get('/certificates', [MemberCertificateController::class, 'show'])->name('certificates.show');
    Route::get('/qr/{registration}', [MemberQrController::class, 'show'])->name('qr.show');

    Route::resource('events', EventMemberController::class)->only(['index', 'show']);
    Route::resource('payments', MemberPaymentController::class)->only(['create', 'store']);
});

// 🧾 Panitia Routes
Route::middleware(['auth', 'role:panitia'])->prefix('panitia')->name('panitia.')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.panitia'))->name('dashboard');
    Route::get('/scan/{registration}', [PanitiaScanController::class, 'scan'])->name('scan');
    Route::get('/certificate/{registration}/upload', [PanitiaCertificateController::class, 'create'])->name('certificate.create');
    Route::post('/certificate/{registration}/upload', [PanitiaCertificateController::class, 'store'])->name('certificate.store');
});

// 💰 Keuangan Routes
Route::middleware(['auth', 'role:keuangan'])->prefix('keuangan')->name('keuangan.')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.keuangan'))->name('dashboard');
    Route::post('/verifikasi/{registration}', function ($id) {
    \App\Models\EventRegistration::where('id', $id)->update(['status' => 'verified']);
    return redirect()->back()->with('success', 'Pembayaran telah diverifikasi.');
})->name('keuangan.verify');
    Route::post('/registrations/{registration}/verify', [\App\Http\Controllers\KeuanganRegistrationController::class, 'verify'])
        ->middleware(['auth', 'role:keuangan'])
        ->name('keuangan.registrations.verify');
});

// 🙍 Profile Routes (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔐 Auth Routes
require __DIR__.'/auth.php';