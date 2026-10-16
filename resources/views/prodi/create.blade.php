@extends('layouts.app')

@section('title', 'Tambah Program Studi | SIM Mahasiswa')

@section('content')
    <section class="glass-panel ios-glass">
        <h1 class="page-title">Tambah Program Studi</h1>
        <p class="page-subtitle">Masukkan kode dan nama program studi.</p>

        @if($errors->any())
            <div class="alert-error">
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('prodi.store') }}" method="POST" class="form-stack">
            @csrf
            <div class="form-field">
                <label for="kode_prodi" class="field-label">Kode Prodi</label>
                <input type="text" id="kode_prodi" name="kode_prodi" class="field-input" value="{{ old('kode_prodi') }}" required>
            </div>
            <div class="form-field">
                <label for="nama_prodi" class="field-label">Nama Prodi</label>
                <input type="text" id="nama_prodi" name="nama_prodi" class="field-input" value="{{ old('nama_prodi') }}" required>
            </div>
            <div class="action-row">
                <button type="submit" class="button button-primary jelly-hover">Simpan</button>
                <a href="{{ route('prodi.index') }}" class="button jelly-hover">Batal</a>
            </div>
        </form>
    </section>
@endsection