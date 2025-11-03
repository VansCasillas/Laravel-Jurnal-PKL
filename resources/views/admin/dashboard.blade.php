@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container-fluid py-2">
  <div class="row mb-3">
    <div class="col-12">
      <h3 class="h4 font-weight-bolder">Dashboard</h3>
    </div>
  </div>

  <div class="row g-3"> <!-- g-3 untuk gap antar card -->
    <div class="col-xl-3 col-sm-6">
      <div class="card h-100">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="text-sm mb-0 text-capitalize">Jumlah Siswa</p>
              <h4 class="mb-0">{{ $totalSiswa }}</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">person</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm">Total <span><a href="{{ route('admin.siswa.index') }}" class="text-success font-weight-bolder">Siswa</a></span> PKL</p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6">
      <div class="card h-100">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="text-sm mb-0 text-capitalize">Jumlah Pembimbing</p>
              <h4 class="mb-0">{{ $totalPembimbing }}</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">person</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm">Total <span><a href="{{ route('admin.siswa.index') }}" class="text-success font-weight-bolder">Pembimbing</a></span> Siswa</p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6">
      <div class="card h-100">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="text-sm mb-0 text-capitalize">Jurusan</p>
              <h4 class="mb-0">{{ $jurusan }}</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">co_present</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm">Total <span><a href="{{ route('admin.siswa.index') }}" class="text-success font-weight-bolder">Jurusan</a></span> di Sekolah</p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6">
      <div class="card h-100">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="text-sm mb-0 text-capitalize">Tempat PKL</p>
              <h4 class="mb-0">{{ $dudi }}</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">domain</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm">Total <span><a href="{{ route('admin.siswa.index') }}" class="text-success font-weight-bolder">Dunia Industri</a></span></p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
