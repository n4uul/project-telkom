@extends('layouts.app')

@section('title', 'Mata Kuliah | SIM Mahasiswa')

@section('content')
    <section class="glass-panel ios-glass">
        <h1 class="page-title">Daftar Mata Kuliah</h1>
        <div class="action-row">
            <a href="{{ route('home') }}" class="text-link jelly-hover">Kembali ke Dashboard</a>
            <a href="{{ route('mata-kuliah.create') }}" class="button button-primary jelly-hover">Tambah Ekstrakurikuler</a>
        </div>

        <div class="table-wrap">
            <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Nama Ekstrakurikuler</th>
                <th>SKS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mataKuliahs as $key => $mk)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $mk->kode_mk }}</td>
                <td>{{ $mk->nama_mk }}</td>
                <td>{{ $mk->sks }}</td>
                <td>
                    <a href="{{ route('mata-kuliah.edit', $mk->id) }}">Edit</a> |
                    <form action="{{ route('mata-kuliah.destroy', $mk->id) }}" method="POST" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button class="button button-danger" type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($mataKuliahs->isEmpty())
            <tr>
                <td colspan="5" class="empty-state">Belum ada data Ekstrakurikuler.</td>
            </tr>
            @endif
        </tbody>
            </table>
        </div>
    </section>
@endsection