@extends('layouts.app')

@section('title', 'Edit Program Studi | SIM Mahasiswa')

@section('content')
    <section class="glass-panel ios-glass">
        <h1 class="page-title">Edit Program Studi</h1>
        <p class="page-subtitle">Perbarui kode atau nama program studi.</p>

        @if($errors->any())
            <div class="alert-error">
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('prodi.update', $prodi->id) }}" method="POST" class="form-stack">
            @csrf
            @method('PUT')
            <div class="form-field">
                <label for="kode_prodi" class="field-label">Kode Prodi</label>
                <input type="text" id="kode_prodi" name="kode_prodi" class="field-input" value="{{ old('kode_prodi', $prodi->kode_prodi) }}" required>
            </div>
            <div class="form-field">
                <label for="nama_prodi" class="field-label">Nama Prodi</label>
                <input type="text" id="nama_prodi" name="nama_prodi" class="field-input" value="{{ old('nama_prodi', $prodi->nama_prodi) }}" required>
            </div>
            <div class="action-row">
                <button type="submit" class="button button-primary jelly-hover">Update</button>
                <a href="{{ route('prodi.index') }}" class="button jelly-hover">Batal</a>
            </div>
        </form>
    </section>
@endsection