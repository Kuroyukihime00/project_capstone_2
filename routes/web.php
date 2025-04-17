<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

// Controllers
use App\Http\Controllers\{
    DemoController,
    EmployeeController,
    LecturerController,
    ProfileController,
    StudentController,
    HomeController,
    LetterRequestController,
    ApprovalController,
    DocumentUploadController,
    DashboardController
};

// 🔄 Redirect setelah login berdasarkan role
Route::get('/home', function () {
    $user = Auth::user();
    if (!$user) return redirect('/login');

    return match ($user->role->name) {
        'admin'     => redirect()->route('admin.dashboard'),
        'mahasiswa' => redirect()->route('letter-requests.index'),
        'kaprodi'   => redirect()->route('approvals.index'),
        'manajer'   => redirect()->route('uploads.index'),
        default     => redirect('/login')->withErrors(['role' => 'Role tidak dikenali.']),
    };
})->middleware('auth')->name('home');


// 🔐 Profile Management (All Authenticated Users)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// 🛡️ Admin Only
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.admin'))->name('dashboard');
    Route::resource('employee', EmployeeController::class)->except(['show']);
    Route::resource('lecturer', LecturerController::class)->except(['show']);
    Route::resource('student', StudentController::class);
});


// 🎓 Mahasiswa Only
Route::middleware(['auth', 'role:mahasiswa'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.student'))->name('dashboard');
    Route::resource('/letter-requests', LetterRequestController::class)->names('letter-requests');
});


// 👨‍🏫 Kaprodi Only
Route::middleware(['auth', 'role:kaprodi'])->prefix('approvals')->name('approvals.')->group(function () {
    Route::get('/', [ApprovalController::class, 'index'])->name('index');
    Route::get('{id}', [ApprovalController::class, 'show'])->name('show');
    Route::post('{id}/approve', [ApprovalController::class, 'approve'])->name('approve');
    Route::post('{id}/reject', [ApprovalController::class, 'reject'])->name('reject');
});


// 🧑‍💼 Manager / TU
Route::middleware(['auth', 'role:manajer'])->prefix('uploads')->name('uploads.')->group(function () {
    Route::get('/', [DocumentUploadController::class, 'index'])->name('index');
    Route::get('{id}', [DocumentUploadController::class, 'uploadForm'])->name('form');
    Route::post('{id}', [DocumentUploadController::class, 'upload'])->name('upload');
});


// 📊 Universal Dashboard Entry Point
Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// 🧪 Demo route
Route::get('/1', fn() => view('demo.file1'));
Route::get('/2', [DemoController::class, 'index']);

require __DIR__ . '/auth.php';
