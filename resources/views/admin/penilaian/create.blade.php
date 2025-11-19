@extends('layouts.app')

@section('title', 'Create Penilaian Siswa')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Aspek Penilaian</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('admin.penilaian.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="kelas" class="form-label fw-semibold text-dark">Soft Skill</label>
            <select id="" name="kriteria" class="form-control styled-input">
                <option value="Soft Skill">Soft Skill</option>
            </select>
            @error('kriteria') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        
        <div class="mb-3">
            <label for="kelas" class="form-label fw-semibold text-dark">Aspek Penilaian</label>
            <input type="text" id="" name="aspek_penilaian" class="form-control styled-input">
            @error('aspek_penilaian') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-dark px-4">Simpan</button>
            <a href="{{ route('admin.penilaian.index') }}" class="btn btn-outline-secondary px-4 ms-2">Kembali</a>
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
