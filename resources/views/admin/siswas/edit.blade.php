@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Ubah Siswa</h2>

    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Nama</label>
            <input type="text" id="name" name="name" value="{{ $siswa->name }}" class="form-control styled-input" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold text-dark">Email</label>
            <input type="email" id="email" name="email" value="{{ $siswa->email }}" class="form-control styled-input" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- NISN --}}
        <div class="mb-3">
            <label for="nisn" class="form-label fw-semibold text-dark">NISN</label>
            <input type="text" id="nisn" name="nisn" value="{{ $siswa->siswa->nisn ?? '' }}" class="form-control styled-input">
            @error('nisn') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Kelas --}}
        <div class="mb-3">
            <label for="kelas" class="form-label fw-semibold text-dark">Kelas</label>
            <select id="kelas" name="id_kelas" class="form-control styled-input" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelas as $kel)
                <option value="{{ $kel->id }}"
                    {{ $siswa->siswa->id_kelas == $kel->id ? 'selected' : '' }}>
                    {{ $kel->kelas }}
                </option>
                @endforeach
            </select>
            @error('id_kelas') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Jurusan --}}
        <div class="mb-3">
            <label for="jurusan" class="form-label fw-semibold text-dark">Jurusan</label>
            <select id="jurusan" name="id_jurusan" class="form-control styled-input" required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach ($jurusans as $jur)
                <option value="{{ $jur->id }}"
                    {{ $siswa->siswa->id_jurusan == $jur->id ? 'selected' : '' }}>
                    {{ $jur->jurusan }}
                </option>
                @endforeach
            </select>
            @error('id_jurusan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Dudi / Tempat PKL --}}
        <div class="mb-3">
            <label for="nama_dudi" class="form-label fw-semibold text-dark">Tempat PKL</label>
            <select id="nama_dudi" name="id_dudi" class="form-control styled-input" required>
                <option value="">-- Pilih Tempat PKL --</option>
                @foreach ($dudis as $dudi)
                <option value="{{ $dudi->id }}"
                    {{ $siswa->siswa->id_dudi == $dudi->id ? 'selected' : '' }}>
                    {{ $dudi->nama_dudi }}
                </option>
                @endforeach
            </select>
            @error('id_dudi') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Pembimbing --}}
        <div class="mb-3">
            <label for="pembimbing" class="form-label fw-semibold text-dark">Pembimbing</label>
            <select id="pembimbing" name="id_pembimbing" class="form-control styled-input" required>
                <option value="">-- Pilih Pembimbing --</option>
                @foreach ($pembimbings as $pemb)
                <option value="{{ $pemb->id }}"{{ $siswa->siswa->id_pembimbing == $pemb->id ? 'selected' : '' }}>{{ $pemb->name }}</option>
                @endforeach
            </select>
            @error('id_pembimbing') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold text-dark">Password</label>
            <input type="password" id="password" name="password" class="form-control styled-input">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-dark px-4">Ubah</button>
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary px-4 ms-2">Kembali</a>
        </div>
    </form>
</div>

<style>
    .styled-input {
        border: 1.5px solid #bbb;
        border-radius: 8px;
        padding: 10px 12px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .styled-input:focus {
        border-color: #000;
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
        outline: none;
    }
</style>
@endsection