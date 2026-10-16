@extends('layouts.app')

@section('title', 'Tambah Mahasiswa | SIM Mahasiswa')

@section('content')
    <section class="glass-panel ios-glass">
        <h1 class="page-title">Tambah Pembina</h1>
        <p class="page-subtitle">Lengkapi identitas dan pilih program studi.</p>

        @if($errors->any())
            <div class="alert-error">
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('mahasiswa.store') }}" method="POST" class="form-stack">
            @csrf
            <div class="form-field">
                <label for="nim" class="field-label">NIM</label>
                <input type="text" id="nim" name="nim" class="field-input" value="{{ old('nim') }}" required>
            </div>
            <div class="form-field">
                <label for="nama" class="field-label">Nama Mahasiswa</label>
                <input type="text" id="nama" name="nama" class="field-input" value="{{ old('nama') }}" required>
            </div>
            <div class="form-field">
                <label for="program_studi_id" class="field-label">Program Studi</label>
                <select id="program_studi_id" name="program_studi_id" class="field-input" required>
                    <option value="">Pilih Program Studi</option>
                    @foreach($prodis as $prodi)
                        <option value="{{ $prodi->id }}" {{ old('program_studi_id') == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="action-row">
                <button type="submit" class="button button-primary jelly-hover">Simpan</button>
                <a href="{{ route('mahasiswa.index') }}" class="button jelly-hover">Batal</a>
            </div>
        </form>
    </section>
@endsection