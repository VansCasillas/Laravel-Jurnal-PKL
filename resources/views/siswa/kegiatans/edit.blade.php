@extends('layouts.app')

@section('title', 'Edit Kegiatan Siswa')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Kegiatan</h2>

    <form action="{{ route('siswa.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tanggal" class="form-label fw-semibold text-dark">Tanggal hari ini</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control styled-input" value="{{ $kegiatan->tanggal }}">
            @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="jam_mulai" class="form-label fw-semibold text-dark">Jam Mulai</label>
            <input type="time" id="jam_mulai" name="jam_mulai" class="form-control styled-input" value="{{ $kegiatan->jam_mulai }}">
            @error('jam_mulai') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="jam_selesai" class="form-label fw-semibold text-dark">Jam Selesai</label>
            <input type="time" id="jam_selesai" name="jam_selesai" class="form-control styled-input" value="{{ $kegiatan->jam_selesai }}">
            @error('jam_selesai') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="kegiatan" class="form-label fw-semibold text-dark">Kegiatan</label>
            <input type="text" id="kegiatan" name="kegiatan" class="form-control styled-input" value="{{ $kegiatan->kegiatan }}">
            @error('kegiatan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="dokumentasi" class="form-label fw-semibold text-dark">dokumentasi</label>
            <input type="file" id="dokumentasi" name="dokumentasi" class="form-control styled-input">
            @error('dokumentasi') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-dark px-4">Simpan</button>
            <a href="{{ route('siswa.kegiatan.index') }}" class="btn btn-outline-secondary px-4 ms-2">Kembali</a>
        </div>
    </form>
</div>

<style>
    /* 🔹 Styling input biar kotaknya jelas */
    .styled-input {
        border: 1.5px solid #bbb;
        border-radius: 8px;
        padding: 10px 12px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .styled-input:focus {
        border-color: #000;
        box-shadow: 0 0 0 2px rgba(0,0,0,0.1);
        outline: none;
    }

    label {
        margin-bottom: 6px;
    }
</style>
@endsection
