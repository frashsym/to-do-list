<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TugasController;
use App\Http\Middleware\HakAksesUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Bagian Tugas
Route::prefix('tugas')->middleware(['auth', 'verified', HakAksesUser::class])->group(function () {
    Route::get('/', [TugasController::class, 'index'])->name('tugas.index'); // Menampilkan daftar tugas
    Route::get('/create', [TugasController::class, 'create'])->name('tugas.create'); // Menampilkan halaman tambah tugas
    Route::get('/{id}/edit', [TugasController::class, 'edit'])->name('tugas.edit'); // Menampilkan halaman edit tugas
    Route::get('/{id}/delete', [TugasController::class, 'confirm'])->name('tugas.confirm'); // Menampilkan halaman delete tugas
    Route::post('/', [TugasController::class, 'store'])->name('tugas.store'); // Membuat tugas baru
    Route::put('/{id}', [TugasController::class, 'update'])->name('tugas.update'); // Mengedit tugas
    Route::delete('/{id}', [TugasController::class, 'delete'])->name('tugas.delete'); // Menghapus tugas
});

// Semua user bisa menampilkan detail tugas user lain 
Route::get('tugas/{id}', [TugasController::class, 'show'])->name('tugas.show'); // Menampilkan detail tugas

require __DIR__.'/auth.php';
