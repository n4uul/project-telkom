<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramStudi;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $prodis = ProgramStudi::all();
        return view('prodi.index', compact('prodis'));
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_prodi' => 'required|unique:program_studis',
            'nama_prodi' => 'required',
        ]);

        ProgramStudi::create($request->all());

        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil ditambahkan');
    }

    public function edit(ProgramStudi $prodi)
    {
        return view('prodi.edit', compact('prodi'));
    }

    public function update(Request $request, ProgramStudi $prodi)
    {
        $request->validate([
            'kode_prodi' => 'required|unique:program_studis,kode_prodi,' . $prodi->id,
            'nama_prodi' => 'required',
        ]);

        $prodi->update($request->all());

        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil diperbarui');
    }

    public function destroy(ProgramStudi $prodi)
    {
        $prodi->delete();
        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil dihapus');
    }
}
