@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Dudi</h2>

    <form action="{{ route('admin.dudi.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="nama_dudi" class="form-label fw-semibold text-dark">Nama dudi</label>
            <input type="text" id="nama_dudi" name="nama_dudi" class="form-control styled-input" required>
            @error('nama_dudi') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="jenis_usaha" class="form-label fw-semibold text-dark">Jenis usaha</label>
            <input type="text" id="jenis_usaha" name="jenis_usaha" class="form-control styled-input" required>
            @error('jenis_usaha') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label fw-semibold text-dark">Alamat</label>
            <input type="text" id="alamat" name="alamat" class="form-control styled-input" required>
            @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="pimpinan" class="form-label fw-semibold text-dark">Pimpinan</label>
            <input type="text" id="pimpinan" name="pimpinan" class="form-control styled-input" required>
            @error('pimpinan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="pembimbing" class="form-label fw-semibold text-dark">Pembimbing</label>
            <input type="text" id="pembimbing" name="pembimbing" class="form-control styled-input" required>
            @error('pembimbing') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="kontak" class="form-label fw-semibold text-dark">Kontak</label>
            <input type="text" id="kontak" name="kontak" class="form-control styled-input" required>
            @error('kontak') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-dark px-4">Simpan</button>
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary px-4 ms-2">Kembali</a>
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
