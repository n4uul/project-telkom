<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil jumlah total data dari masing-masing tabel
        $totalProdi = ProgramStudi::count();
        $totalMataKuliah = MataKuliah::count();
        $totalMahasiswa = Mahasiswa::count();

        return view('home', compact('totalProdi', 'totalMataKuliah', 'totalMahasiswa'));
    }
}
