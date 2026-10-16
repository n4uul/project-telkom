@extends('layouts.app')

@section('title', 'Program Studi | SIM Mahasiswa')

@section('content')
    <section class="glass-panel ios-glass">
        <h1 class="page-title">Daftar Program Studi</h1>
        <div class="action-row">
            <a href="{{ route('home') }}" class="text-link jelly-hover">Kembali ke Dashboard</a>
            <a href="{{ route('prodi.create') }}" class="button button-primary jelly-hover">Tambah Prodi</a>
        </div>

        <div class="table-wrap">
            <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Prodi</th>
                <th>Nama Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prodis as $key => $p)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $p->kode_prodi }}</td>
                <td>{{ $p->nama_prodi }}</td>
                <td>
                    <a href="{{ route('prodi.edit', $p->id) }}">Edit</a> |
                    <form action="{{ route('prodi.destroy', $p->id) }}" method="POST" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button class="button button-danger" type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="empty-state">Belum ada data Program Studi.</td>
            </tr>
            @endforelse
        </tbody>
            </table>
        </div>
    </section>
@endsection