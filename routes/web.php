<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    EventMemberController,
    MemberPaymentController,
    PanitiaScanController,
    PanitiaCertificateController,
    PanitiaEventController,
    PanitiaEventSessionController,
    MemberCertificateController,
    AdminUserController,
    AdminEventSessionController,
    MemberQrController,
    ProfileController
};

use App\Models\Event;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    $events = Event::latest()->get();
    return view('guest.events', compact('events'));
});

// 🧭 Universal Redirector ke dashboard per role
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// 👑 Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.admin'))->name('dashboard');
    Route::resource('users', AdminUserController::class)->except(['show']);
    Route::resource('sessions', AdminEventSessionController::class)->except(['show']);
    Route::get('/sessions', [AdminEventSessionController::class, 'index'])->name('sessions.index');
    Route::get('/sessions/create', [AdminEventSessionController::class, 'create'])->name('sessions.create');
    Route::post('/sessions', [AdminEventSessionController::class, 'store'])->name('sessions.store');
});

// 👤 Member Routes
Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.member'))->name('dashboard');

    Route::get('/events/{event}/register', [EventMemberController::class, 'register'])->name('events.register');
    Route::post('/events/register', [\App\Http\Controllers\MemberEventController::class, 'store'])->name('events.store');

    Route::get('/payments/{registration}/create', [MemberPaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [MemberPaymentController::class, 'store'])->name('member.payments.store');

    Route::get('/certificates/{registration}/download', [MemberCertificateController::class, 'download'])->name('certificates.download');
    Route::get('/certificates', [MemberCertificateController::class, 'show'])->name('certificates.show');

    Route::get('/qr/{registration}', [MemberQrController::class, 'show'])->name('qr.show');

    Route::resource('events', EventMemberController::class)->only(['index', 'show']);
});

// 🧾 Panitia Routes
Route::middleware(['auth', 'role:panitia'])->prefix('panitia')->name('panitia.')->group(function () {
    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard.panitia'))->name('dashboard');

    // Event Management (Create)
    Route::get('/events/create', [PanitiaEventController::class, 'create'])->name('events.create');
    Route::post('/events', [PanitiaEventController::class, 'store'])->name('events.store');
    Route::get('/events', [PanitiaEventController::class, 'index'])->name('panitia.events.index');

    // Sesi Event - Kelola & Tambah
    Route::get('/sessions', [PanitiaEventSessionController::class, 'index'])->name('sessions.index');
    Route::get('/sessions/create/{event}', [PanitiaEventSessionController::class, 'create'])->name('sessions.create');
    Route::post('/sessions/{event}', [PanitiaEventSessionController::class, 'store'])->name('sessions.store');

    // Scan QR & Upload Sertifikat
    Route::get('/scan', [PanitiaScanController::class, 'index'])->name('scan.index');
    Route::get('/scan/{registration}', [PanitiaScanController::class, 'scan'])->name('scan');
    Route::get('/certificate/{registration}/upload', [PanitiaCertificateController::class, 'create'])->name('certificate.create');
    Route::post('/certificate/{registration}/upload', [PanitiaCertificateController::class, 'store'])->name('certificate.store');
    Route::get('/certificate/{registration}/qr', [PanitiaCertificateController::class, 'qr'])->name('certificate.qr');

    // [Opsional jika panitia bisa upload bukti pembayaran] - seharusnya ini milik member
    Route::get('/payments/upload', [MemberPaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/upload', [MemberPaymentController::class, 'store'])->name('payments.upload');
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