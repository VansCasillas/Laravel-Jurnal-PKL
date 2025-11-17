@extends('layouts.app')

@section('title', 'Kelola Siswa')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Siswa table</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
        <div class="card-body px-3 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="siswa">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nis</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Kelamin</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dudi</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $sw)
                        <tr>
                            <td class="text-center align-middle text-sm">{{ $sw->user->name }}</td>
                            <td class="text-center align-middle text-left text-sm">{{ $sw->nis }}</td>
                            <td class="text-center align-middle text-left text-sm">{{ $sw->kelamin }}</td>
                            <td class="text-center align-middle text-left text-sm">{{ $sw->kelas->kelas }}</td>
                            <td class="text-center align-middle text-left text-sm">{{ $sw->jurusan->jurusan }}</td>
                            <td class="text-center align-middle text-left text-sm">{{ $sw->dudi->nama_dudi }}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('pembimbing.siswa.kegiatan', $sw->id) }}" style="position: relative; top: 7px;" class="btn btn-warning btn-sm">Kegiatan</a>
                                    <a href="{{ route('pembimbing.siswa.absen', $sw->id) }}" style="position: relative; top: 7px;" class="btn btn-info btn-sm">Absensi</a>
                                </div>
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
        $('#siswa').DataTable();
    });
</script>
@endsection