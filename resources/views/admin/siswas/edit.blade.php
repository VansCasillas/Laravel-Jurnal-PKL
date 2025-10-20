@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Ubah Siswa</h2>

    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Nama</label>
            <input type="text" id="name" name="name" value="{{ $siswa->name }}" class="form-control styled-input" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold text-dark">Email</label>
            <input type="email" id="email" name="email" value="{{ $siswa->email }}" class="form-control styled-input" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="nisn" class="form-label fw-semibold text-dark">NISN</label>
            <input type="text" id="nisn" name="nisn" value="{{ $siswa->nisn }}" class="form-control styled-input">
            @error('nisn') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold text-dark">Password</label>
            <input type="password" id="password" name="password" value="{{ $siswa->password }}" class="form-control styled-input" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-dark px-4">Ubah</button>
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
