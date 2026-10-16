<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\MahasiswaController;
use App\Models\ProgramStudi;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;

/*
|--------------------------------------------------------------------------
| Web Routes 
|--------------------------------------------------------------------------
*/

// Halaman Utama / Dashboard
Route::get('/', function () {
    $totalProdi = ProgramStudi::count();
    $totalMataKuliah = MataKuliah::count();
    $totalMahasiswa = Mahasiswa::count();
    return view('home', compact('totalProdi', 'totalMataKuliah', 'totalMahasiswa'));
})->name('home');

// Route CRUD 
Route::resource('prodi', ProgramStudiController::class);
Route::resource('mata-kuliah', MataKuliahController::class);
Route::resource('mahasiswa', MahasiswaController::class);

// Route Autentikasi (Login & Logout)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', function (Request $request) {
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');