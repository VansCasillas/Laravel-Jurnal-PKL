@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container-fluid py-2">
    <div class="row mb-3">
        <div class="col-12">
            <h3 class="h4 font-weight-bolder">Dashboard</h3>
        </div>
    </div>

    <div class="row g-3">
        <!-- Total Absen -->
        <div class="col-12 col-xl-6">
            <div class="mb-3">
                <div class="card h-100">
                    <div class="card-header card-footer p-2 ps-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Total Siswa yang dibimbing</p>
                                <h4 class="mb-0">{{ $totalSiswaP }}</h4>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">group</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
            </div>

            <!-- Total Kegiatan -->
            <div>
                <div class="card h-100">
                    <div class="card-header card-footer p-2 ps-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-sm mb-3 text-capitalize">Total Kegiatan</p>
                                <ul class="list-group gap-2">
                                    @foreach ($dudiSiswa as $dudi)
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 pt-0">
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $dudi->nama_dudi ?? 'Belum diisi' }}</h6>
                                            <p class="mb-0 text-xs">{{ $dudi->alamat ?? 'Belum ada kelas' }}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">domain</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- daftar siswa yg di bimbing -->
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-3">Daftar siswa yg dibimbing</h6>
                    <ul class="list-group gap-2">
                        @foreach ($siswaDibimbing as $bimbing)
                        <li class="list-group-item border-0 d-flex align-items-center px-0 pt-0">
                            <div class="avatar me-3">
                                <img src="{{ $bimbing->foto_profil && file_exists(storage_path('app/public/' . $bimbing->foto_profil)) 
                                ? asset('storage/' . $bimbing->foto_profil) 
                                : asset('assets/img/kal-visuals-square.jpg') }}" alt="kal" style="object-fit: cover;" class="border-radius-lg shadow">
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $bimbing->user->name ?? 'Belum diisi' }}</h6>
                                <p class="mb-0 text-xs">{{ $bimbing->kelas->kelas ?? 'Belum ada kelas' }} - {{ $bimbing->jurusan->jurusan ?? 'Belum ada jurusan' }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection