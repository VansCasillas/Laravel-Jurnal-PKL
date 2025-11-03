@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container-fluid py-2">
    <div class="row mb-3">
        <div class="col-12">
            <h3 class="h4 font-weight-bolder">Dashboard</h3>
        </div>
    </div>

    <div class="row g-3"> <!-- g-3 untuk gap antar card -->
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
                                <i class="material-symbols-rounded opacity-10">calendar_check</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm">Total Semua <span class="text-success font-weight-bolder">Absen</span></p>
                    </div>
                </div>
            </div>
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
                        <p class="mb-0 text-sm">Total Semua <span class="text-success font-weight-bolder">Kegiatan</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
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
                    <p class="mb-0 text-sm">Total Semua <span class="text-success font-weight-bolder">Kegiatan</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection