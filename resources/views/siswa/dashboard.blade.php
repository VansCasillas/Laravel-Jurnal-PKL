@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container-fluid py-2">
    <div class="row mb-3">
        <div class="col-12">
            <h3 class="h4 font-weight-bolder">Dashboard</h3>
        </div>
    </div>

    <div class="row g-3">
        <!-- Total Absen -->
        <div class="col-xl-6 col-sm-6">
            <div class="mb-3">
                <div class="card h-100">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Total Absen</p>
                                <h4 class="mb-0">{{ $totalAbsen }}</h4>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">calendar_month</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm">Total Semua <span><a class="text-success font-weight-bolder" href="{{ route('siswa.absensi.index') }}">Absen</a></span></p>
                    </div>
                </div>
            </div>

            <!-- Total Kegiatan -->
            <div>
                <div class="card h-100">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Total Kegiatan</p>
                                <h4 class="mb-0">{{ $totalKegiatan }}</h4>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">browse_activity</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm">Total Semua <span><a class="text-success font-weight-bolder" href="{{ route('siswa.kegiatan.index') }}">Kegiatan</a></span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Absensi Hari Ini -->
        <div class="col-xl-6 col-sm-6">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-gradient-dark text-white d-flex justify-content-between align-items-center py-3">
                    <div class="d-flex align-items-center">
                        <i class="material-symbols-rounded me-2">calendar_check</i>
                        <h5 class="mb-0 text-white">Absensi Hari Ini</h5>
                    </div>
                    <span class="badge bg-light text-dark">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="card-body p-4">
                    @if($absensiHariIni)
                    <div class="row g-3">
                        <!-- Status dengan Badge -->
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-sm text-muted">Status</span>
                                @php
                                $statusColor = match($absensiHariIni->status) {
                                'Hadir' => 'success',
                                'Izin' => 'info',
                                'Sakit' => 'danger',
                                'Alpha' => 'warning',
                                default => 'secondary'
                                };
                                @endphp
                                <span class="badge bg-{{ $statusColor }} fs-7 px-3 py-2">
                                    {{ $absensiHariIni->status }}
                                </span>
                            </div>
                        </div>

                        @if($absensiHariIni->status === 'Hadir')
                        <!-- Waktu Absensi -->
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-sm text-muted">Waktu</span>
                                <span class="fw-bold">
                                    {{ \Carbon\Carbon::parse($absensiHariIni->jam_mulai)->translatedFormat('H:i') }} -
                                    {{ \Carbon\Carbon::parse($absensiHariIni->jam_selesai)->translatedFormat('H:i') }}
                                </span>
                            </div>
                        </div>
                        @endif

                        <!-- Keterangan -->
                        @if($absensiHariIni->keterangan)
                        <div class="col-12">
                            <div class="border-top pt-3">
                                <span class="text-sm text-muted d-block mb-1">Keterangan</span>
                                <p class="mb-0 text-dark bg-light rounded p-3">
                                    <i class="material-symbols-rounded me-1 text-muted" style="font-size: 16px">notes</i>
                                    {{ $absensiHariIni->keterangan }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                    @else
                    <!-- State ketika belum absen -->
                    <div class="text-center py-4">
                        <div class="icon icon-lg text-muted mb-3">
                            <i class="material-symbols-rounded opacity-50" style="font-size: 64px">schedule</i>
                        </div>
                        <h6 class="text-muted mb-3">Belum ada absensi hari ini</h6>
                        <p class="text-muted small mb-4">Lakukan absensi untuk mencatat kehadiran Anda hari ini</p>
                        <a href="{{ route('siswa.absensi.index') }}" class="btn btn-dark bg-gradient-dark btn-lg">
                            <i class="material-symbols-rounded me-2">how_to_reg</i>
                            Absensi Sekarang
                        </a>
                    </div>
                    @endif
                </div>

            </div>

        </div>
        <div class="col-12 mt-6">
            <div class="mb-3 ps-3">
                <h6 class="mb-1">Kegiatan</h6>
                <p class="text-sm">Beberapa laporan kegiatan PKL</p>
            </div>
            <div class="row gap-3">
                @foreach ($kegiatans as $k)
                <div class="card shadow-xl col-xl-3 col-md-6 mb-xl-0 mb-4">
                    <div class="card card-blog card-plain">
                        <div class="card-header p-0 m-2">
                            <a class="d-block shadow-xl border-radius-xl">
                                <img src="{{ asset('storage/' . $k->dokumentasi) }}" alt="Dokumentasi" class="img-fluid shadow border-radius-lg">
                            </a>
                        </div>
                        <div class="card-body p-3">
                            <p class="mb-0 text-sm">Project #{{ $k->id }}</p>
                            <h5>
                                {{ Str::limit($k->kegiatan, 40, '...') }}
                            </h5>
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="{{ route('siswa.kegiatan.show', $k->id) }}" type="button" class="btn btn-outline-primary btn-sm mb-0"><i class="material-symbols-rounded" style="position: relative; font-size: 14px;">open_in_new</i> View Project</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .icon-shape {
        border-radius: 10px;
    }

    .badge {
        border-radius: 8px;
        font-weight: 500;
    }

    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .text-sm {
        font-size: 0.875rem;
    }
</style>
@endsection