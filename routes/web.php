<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\DosenController;
use App\http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('layouts/index');
});
Route::get('/1', function () {
    return view('demo/file1');
});
Route::get('/2', function () {
    return view('demo/file2');
});
Route::get('/3',[DemoController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
});


Route::middleware(['auth','verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', function () {
        return view('starter');
    })->name('dashboard');

    Route::middleware(['role:3'])->group(function(){
        Route::get('/employee', [EmployeeController::class, 'index'])->name('employeeList');
        Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employeeCreate');
        Route::post('/employee/create', [EmployeeController::class, 'store'])->name('employeeStore');
        Route::put('/employee/edit/{nip}', [EmployeeController::class, 'update'])->name('employeeUpdate');
        Route::get('/employee/delete/{nip}', [EmployeeController::class, 'destroy'])->name('employeeDelete');
    });

    Route::middleware(['role:1,2'])->group(function(){
        Route::get('/dosen', [DosenController::class, 'index'])->name('dosenList');
        Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosenCreate');
        Route::post('/dosen/create', [DosenController::class, 'store'])->name('dosenStore');
        Route::get('/dosen/edit/{dosen}', [DosenController::class, 'edit'])->name('dosenEdit');
        Route::put('/dosen/edit/{nik}', [DosenController::class, 'update'])->name('dosenUpdate');

        Route::get('/mahasiswa',[MahasiswaController::class, 'index'])->name('mahasiswaList');
        Route::get('/mahasiswa/create',[MahasiswaController::class, 'create'])->name('mahasiswaCreate');
    });
    
});
require __DIR__.'/auth.php';
