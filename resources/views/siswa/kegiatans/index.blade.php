@extends('layouts.app')

@section('title', 'Kegiatan Siswa')

@section('content')
<div class="col-12 px-3 my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
            <h6 class="text-white text-capitalize ps-3">Jurnal Kegiatan</h6>
        </div>
    </div>

    <div class="m-3 mb-2">
        <a href="{{ route('siswa.kegiatan.create') }}" class="btn btn-primary mb-3">Tambah Kegiatan</a>

        @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>

    {{-- Jika belum pilih bulan, tampilkan folder --}}
    @if(!$selectedMonth)
    {{-- Folder per bulan --}}
    <div class="row px-3 mb-4">
        @foreach ($folders as $bulan => $daftar)
        @php
        $firstTanggal = \Carbon\Carbon::parse($daftar->first()->tanggal);
        $bulanInt = $firstTanggal->month;
        $tahun = $firstTanggal->year;
        @endphp
        <div class="col-md-3 col-sm-6 mb-3">
            <a href="{{ route('siswa.kegiatan.index', ['bulan' => $bulanInt, 'tahun' => $tahun]) }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 text-center py-4 hover:shadow-lg transition-all">
                    <i class="material-symbols-rounded text-primary mb-2" style="font-size:40px;">folder</i>
                    <h6 class="text-dark fw-bold">{{ $bulan }}</h6>
                    <p class="text-muted small mb-0">{{ $daftar->count() }} kegiatan</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
    {{-- Kalau bulan sudah dipilih, tampilkan daftar kegiatan --}}
    <div class="card-body px-3 pb-2 mt-3">
        <h5 class="text-dark fw-bold mb-3">{{ $namaBulan }}</h5>
        <div class="row">
            @forelse ($kegiatanPerBulan as $ktn)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm border-0 rounded-3 hover:shadow-lg transition-all">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="text-dark fw-bold mb-1" style="word-break: break-word; overflow-wrap: break-word;">
                                    {{ Str::limit($ktn->kegiatan, 40, '...') }}
                                </h6>
                                <p class="text-muted small mb-0">
                                    {{ \Carbon\Carbon::parse($ktn->tanggal)->translatedFormat('d F Y') }}
                                </p>
                            </div>

                            @if ($ktn->dokumentasi)
                            <a href="{{ asset('storage/' . $ktn->dokumentasi) }}" target="_blank" class="text-muted">
                                <i class="material-symbols-rounded opacity-5">image</i>
                            </a>
                            @else
                            <i class="material-symbols-rounded opacity-5">hide_image</i>
                            @endif
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <i class="material-symbols-rounded text-primary me-1">schedule</i>
                            <span class="text-dark">
                                {{ \Carbon\Carbon::parse($ktn->jam_mulai)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($ktn->jam_selesai)->format('H:i') }}
                            </span>
                        </div>

                        {{-- Catatan pembimbing --}}
                        @if ($ktn->catatan_pembimbing)
                        <div class="bg-light rounded-2 p-3 mb-3">
                            <div class="d-flex align-items-start justify-content-between">
                                <div>
                                    <p class="text-sm text-muted mb-2">
                                        <i class="material-symbols-rounded text-secondary me-1" style="font-size: 18px;">comment</i>
                                        <strong>Catatan Pembimbing:</strong>
                                    </p>
                                    <p class="text-sm text-dark mb-0">
                                        {{ Str::limit($ktn->catatan_pembimbing, 80, '...') }}
                                    </p>
                                </div>
                            </div>

                            <div class="text-end mt-2">
                                <a href="{{ route('siswa.kegiatan.show', $ktn->id) }}"
                                    class="text-secondary text-sm">
                                    <i class="material-symbols-rounded" style="font-size: 16px;">open_in_new</i>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                        @else
                        <div class="bg-light rounded-2 p-3 mb-3 text-center">
                            <p class="text-sm text-muted mb-1">Belum ada catatan pembimbing</p>
                        </div>
                        @endif

                        {{-- Tombol detail kegiatan --}}
                        <a href="{{ route('siswa.kegiatan.show', $ktn->id) }}"
                            class="btn btn-sm bg-gradient-light w-100 mb-2">
                            Detail Kegiatan
                        </a>

                        {{-- Aksi --}}
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <!-- <span class="badge bg-gradient-dark">
                                    {{ $siswa->user->name ?? 'Siswa' }}
                                </span> -->

                            <div class="d-flex gap-2">
                                <a style="position: relative; top:7px;" href="{{ route('siswa.kegiatan.edit', $ktn->id) }}" class="btn btn-warning">
                                    <i class="material-symbols-rounded">edit</i>
                                </a>
                                <form action="{{ route('siswa.kegiatan.destroy', $ktn->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button style="position: relative; top:7px;" type="submit" class="btn btn-danger"
                                        onclick="return confirm('Hapus kegiatan ini?')">
                                        <i class="material-symbols-rounded">delete</i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-muted">Belum ada kegiatan di bulan ini.</p>
            @endforelse
        </div>
    </div>
    @endif
</div>
@endsection