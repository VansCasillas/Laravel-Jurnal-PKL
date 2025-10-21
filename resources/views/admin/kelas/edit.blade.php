@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Kelas</h2>

    <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="kelas" class="form-label fw-semibold text-dark">Kelas</label>
            <input type="text" id="kelas" name="kelas" value="{{ $kelas->kelas }}" class="form-control styled-input" required>
            @error('kelas') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-dark px-4">Simpan</button>
            <a href="{{ route('admin.kelas.index') }}" class="btn btn-outline-secondary px-4 ms-2">Kembali</a>
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
