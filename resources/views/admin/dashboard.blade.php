@extends('layouts.app')

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
          <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+55% </span>than last week</p>
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
          <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+3% </span>than last month</p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6">
      <div class="card h-100">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="text-sm mb-0 text-capitalize">Ads Views</p>
              <h4 class="mb-0">3,4</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">leaderboard</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">-2% </span>than yesterday</p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6">
      <div class="card h-100">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="text-sm mb-0 text-capitalize">Sales</p>
              <h4 class="mb-0">$103,430</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">weekend</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>than yesterday</p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
