<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('1', function () {
    return view('demo.file1');
});
Route::get('2', [DemoController::class, 'index']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:1'])->group(function () {
        //  Employee Route
        Route::get('/employee', [EmployeeController::class, 'index'])->name('employee-list');
        Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee-create');
        Route::post('/employee/create', [EmployeeController::class, 'store'])->name('employee-store');
        Route::get('/employee/edit/{nip}', [EmployeeController::class, 'edit'])->name('employee-edit');
        Route::put('/employee/edit/{nip}', [EmployeeController::class, 'update'])->name('employee-update');
        Route::delete('/employee/delete/{nip}', [EmployeeController::class, 'destroy'])->name('employee-delete');
    });

    Route::middleware(['role:1,2'])->group(function () {
        //  Lecturer Route
        Route::get('/lecturer', [LecturerController::class, 'index'])->name('lecturer-list');
        Route::get('/lecturer/create', [LecturerController::class, 'create'])->name('lecturer-create');
        Route::post('/lecturer/create', [LecturerController::class, 'store'])->name('lecturer-store');
        Route::get('/lecturer/edit/{nik}', [LecturerController::class, 'edit'])->name('lecturer-edit');
        Route::put('/lecturer/edit/{nik}', [LecturerController::class, 'update'])->name('lecturer-update');
        Route::delete('/lecturer/delete/{nik}', [LecturerController::class, 'destroy'])->name('lecturer-delete');

        //  Student Route
        Route::get('/student', [StudentController::class, 'index'])->name('student-list');
        Route::get('/student/create', [StudentController::class, 'create'])->name('student-create');
        Route::post('/student/create', [StudentController::class, 'store'])->name('student-store');
        Route::get('/student/edit/{nrp}', [StudentController::class, 'edit'])->name('student-edit');
        Route::put('/student/edit/{nrp}', [StudentController::class, 'update'])->name('student-update');
        Route::delete('/student/delete/{nrp}', [StudentController::class, 'destroy'])->name('student-delete');
        Route::get('/student/detail/{nrp}', [StudentController::class, 'show'])->name('student-detail');
    });

    Route::get('/', function () {
        return view('starter');
    })->name('dashboard');
});

require __DIR__ . '/auth.php';
