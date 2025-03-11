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

Route::get('/dosen', [DosenController::class, 'index'])->name('dosenList');
Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosenCreate');
Route::post('/dosen/create', [DosenController::class, 'store'])->name('dosenStore');

Route::get('/mahasiswa',[MahasiswaController::class, 'index'])->name('mahasiswaList');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
