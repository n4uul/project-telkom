<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with('programStudi')->get();
        $prodis = ProgramStudi::all();

        return view('mahasiswa.index', compact('mahasiswas', 'prodis'));
    }

    public function create()
    {
        $prodis = ProgramStudi::all();
        return view('mahasiswa.create', compact('prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'              => 'required|unique:mahasiswas',
            'nama'             => 'required',
            'program_studi_id' => 'required|exists:program_studis,id',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $prodis = ProgramStudi::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'prodis'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim'              => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama'             => 'required',
            'program_studi_id' => 'required|exists:program_studis,id',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus');
    }
}
