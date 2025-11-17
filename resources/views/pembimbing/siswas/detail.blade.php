@extends('layouts.app')

@section('content')

<!-- Tabs Navigation -->
<ul class="nav nav-tabs mb-3 ps-3" id="customTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active text-dark" id="customers-tab" data-bs-toggle="tab" data-bs-target="#customers"
            type="button" role="tab">Keterangan</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link text-dark" id="accounts-tab" data-bs-toggle="tab" data-bs-target="#accounts" type="button"
            role="tab">Dokumentasi</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link text-dark" id="angela-tab" data-bs-toggle="tab" data-bs-target="#angela" type="button"
            role="tab">Catatan Pembimbing</button>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content ps-3" id="customTabsContent">
    <div class="tab-pane fade show active" id="customers" role="tabpanel">
        <div class="card shadow-sm">
            <div class="card-body">

                <h6 class="fw-bold mb-3">keterangan kegiatan</h6>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Tempat kegiatan:</strong></div>
                    <div class="col-md-8">{{ $kegiatan->siswa->dudi->nama_dudi }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Guru pembing kegiatan:</strong></div>
                    <div class="col-md-8">{{ $kegiatan->siswa->dudi->pembimbing }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Guru pembing kegiatan:</strong></div>
                    <div class="col-md-8">{{ $kegiatan->siswa->pembimbing->name }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Jam mulai kegiatan:</strong></div>
                    <div class="col-md-8">{{ \Carbon\Carbon::parse($kegiatan->jam_mulai)->format('H:i') }} - WIB</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Jam selesai kegiatan:</strong></div>
                    <div class="col-md-8">{{ \Carbon\Carbon::parse($kegiatan->jam_selesai)->format('H:i') }} - WIB</div>
                </div>

                <div class="fw-bold mb-3"><strong>detail kegiatan :</strong></div>
                {{-- Ca --}}
                @if ($kegiatan->kegiatan)
                <div class="bg-light rounded-2 p-3 mb-3">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="text-sm text-dark mb-0">
                                {{ $kegiatan->kegiatan }}
                            </p>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-light rounded-2 p-3 mb-3 text-center">
                    <p class="text-sm text-muted mb-1">Belum ada catatan pembimbing</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="accounts" role="tabpanel">
        <div class="card shadow-sm">
            <div class="card-body">

                <h6 class="fw-bold mb-3">Dokumentasi kegiatan :</h6>
                {{-- Dokumentasi --}}
                @if($kegiatan->dokumentasi)
                <div class="mb-4">
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $kegiatan->dokumentasi) }}" alt="Dokumentasi"
                            class="img-fluid rounded shadow-sm" style="max-width:400px;">
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="angela" role="tabpanel">
        <div class="card shadow-sm">
            <div class="card-body">

                <h6 class="fw-bold mb-3">Catatan Pembimbing :</h6>
                {{-- Catatan Pembimbing --}}
                @if ($kegiatan->catatan_pembimbing)
                <div class="bg-light rounded-2 p-3 mb-3">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="text-sm text-muted mb-2">
                                <i class="material-symbols-rounded text-secondary me-1" style="font-size: 18px;">comment</i>
                                <strong>Catatan Pembimbing:</strong>
                            </p>
                            <p class="text-sm text-dark mb-0">
                                {{ $kegiatan->catatan_pembimbing }}
                            </p>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-light rounded-2 p-3 mb-3 text-center">
                    <p class="text-sm text-muted mb-1">Belum ada catatan pembimbing</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('pembimbing.siswa.kegiatan', $id) }}" class="btn btn-info" >Kembali</a>
    </div>
</div>
@endsection