@extends('layouts.app')

@section('title', 'Edit Mata Kuliah | SIM Mahasiswa')

@section('content')
    <section class="glass-panel ios-glass">
        <h1 class="page-title">Edit Mata Kuliah</h1>
        <p class="page-subtitle">Perbarui informasi mata kuliah.</p>

        @if($errors->any())
            <div class="alert-error">
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('mata-kuliah.update', $mataKuliah->id) }}" method="POST" class="form-stack">
            @csrf
            @method('PUT')
            <div class="form-field">
                <label for="kode_mk" class="field-label">Kode MK</label>
                <input type="text" id="kode_mk" name="kode_mk" class="field-input" value="{{ old('kode_mk', $mataKuliah->kode_mk) }}" required>
            </div>
            <div class="form-field">
                <label for="nama_mk" class="field-label">Nama Mata Kuliah</label>
                <input type="text" id="nama_mk" name="nama_mk" class="field-input" value="{{ old('nama_mk', $mataKuliah->nama_mk) }}" required>
            </div>
            <div class="form-field">
                <label for="sks" class="field-label">Jumlah SKS</label>
                <input type="number" id="sks" name="sks" class="field-input" value="{{ old('sks', $mataKuliah->sks) }}" min="1" required>
            </div>
            <div class="action-row">
                <button type="submit" class="button button-primary jelly-hover">Update</button>
                <a href="{{ route('mata-kuliah.index') }}" class="button jelly-hover">Batal</a>
            </div>
        </form>
    </section>
@endsection