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
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
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
                            <td class="text-center d-flex align-middle gap-2">
                                <a style="position: relative; top: 7px;" href="{{ route('pembimbing.detail', $k->id) }}" class="btn btn-info btn-sm">detail</a>
                                <!-- Button trigger modal -->
                                <button  style="position: relative; top: 7px;"  type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Tambah Komentar
                                </button>
                            </td>
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