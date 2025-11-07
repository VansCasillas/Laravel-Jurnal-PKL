@extends('layouts.app')

@section('title', 'Lihat Kegiatan Siswa')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Kegiatan Siswa table</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
        </div>
        <div class="card-body px-3 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="kegiatan">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">no</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Siswa</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam_mulai</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam_selesai</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kegiatan</th>
                            @if (Auth::user() && Auth::user()->role === 'pembimbing')
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatan as $k)
                        <tr>
                            <td class="text-center align-middle text-sm">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle text-sm">{{ $k->siswa->user->name }}</td>
                            <td class="text-center align-middle text-sm">{{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d F Y') }}</td>
                            <td class="text-center align-middle text-sm">{{ \Carbon\Carbon::parse($k->jam_mulai)->translatedFormat('H:i') }}</td>
                            <td class="text-center align-middle text-sm">{{ \Carbon\Carbon::parse($k->jam_selesai)->translatedFormat('H:i') }}</td>
                            <td class="text-center align-middle text-sm">{{ $k->kegiatan }}</td>
                            @if (Auth::user() && Auth::user()->role === 'pembimbing')
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a style="position: relative; top: 7px;" href="" class="btn btn-warning btn-sm">Tambah Komentar</a>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#kegiatan').DataTable();
    });
</script>
@endsection