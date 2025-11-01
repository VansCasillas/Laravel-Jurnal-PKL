@extends('layouts.app')

@section('title', 'Detail Kegiatan Siswa')

@section('content')
<div class="col-12 my-4 px-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-gradient-dark text-white d-flex justify-content-between align-items-center">
            <span>Detail Kegiatan</span>
            <a href="{{ route('siswa.kegiatan.index') }}" class="btn btn-light btn-sm">Kembali</a>
        </div>

        <div class="card-body p-4">
            {{-- Judul Kegiatan --}}
            <h4 class="fw-bold mb-3">{{ $kegiatan->kegiatan }}</h4>

            {{-- Tanggal & Waktu --}}
            <div class="mb-3 d-flex gap-2 flex-wrap">
                <span class="badge bg-primary">
                    {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}
                </span>
                <span class="badge bg-success">
                    {{ \Carbon\Carbon::parse($kegiatan->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($kegiatan->jam_selesai)->format('H:i') }}
                </span>
            </div>

            {{-- Catatan Pembimbing --}}
            <div class="mb-3 p-3 rounded-2 bg-light">
                <strong>Catatan Pembimbing:</strong>
                <p class="mb-0">{{ $kegiatan->catatan_pembimbing ?? 'Belum ada catatan' }}</p>
            </div>

            {{-- Dokumentasi --}}
            @if($kegiatan->dokumentasi)
            <div class="mb-4">
                <strong>Dokumentasi:</strong>
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $kegiatan->dokumentasi) }}" alt="Dokumentasi"
                        class="img-fluid rounded shadow-sm" style="max-width:400px;">
                </div>
            </div>
            @endif

            {{-- Tombol Aksi --}}
            <div class="d-flex gap-2 flex-wrap mt-4">
                <a href="{{ route('siswa.kegiatan.edit', $kegiatan->id) }}" class="btn btn-warning">
                    <i class="material-symbols-rounded me-1">edit</i> Edit
                </a>

                <form action="{{ route('siswa.kegiatan.destroy', $kegiatan->id) }}" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Hapus kegiatan ini?')">
                        <i class="material-symbols-rounded me-1">delete</i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
