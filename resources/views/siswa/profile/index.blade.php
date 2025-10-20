@extends('layouts.app')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-dark  opacity-6"></span>
    </div>
    <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row gx-3 mb-2">
            <div class="col-auto">
                <!-- <div class="avatar avatar-xl position-relative">
                    <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div> -->
            </div>
            <div class="col-auto my-4">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ Auth::user()->name }}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        <!-- {{ Auth::user()->siswa->kelas->kelas ?? 'Belum ada kelas' }} / -->
                        {{ Auth::user()->siswa->jurusan->jurusan ?? 'Belum ada jurusan' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Profile Information</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="javascript:;">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nama Lengkap:</strong> &nbsp; {{ Auth::user()->name }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">NISN:</strong> &nbsp; {{ Auth::user()->siswa->nisn }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Kelas:</strong> &nbsp; {{ Auth::user()->siswa->kelas->kelas ?? 'Belum ada kelas' }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Jurusan:</strong> &nbsp; {{ Auth::user()->siswa->jurusan->jurusan}}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Pembimbing:</strong> &nbsp; {{ Auth::user()->siswa->pembimbing->name}}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ Auth::user()->email}}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0" style="visibility:hidden;">Profile Information</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="javascript:;">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Kelamin:</strong> &nbsp; {{ Auth::user()->siswa->kelamin ?? 'Belum diisi' }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tempat, Tanggal Lahir:</strong> &nbsp; {{ Auth::user()->siswa->tempat ?? 'Belum' }},{{ Auth::user()->siswa->tanggal_lahir ?? 'diisi' }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Golongan Darah:</strong> &nbsp; {{ Auth::user()->siswa->gol_dar ?? 'Belum diisi' }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alamat:</strong> &nbsp; {{ Auth::user()->siswa->alamat ?? 'Belum diisi' }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Nomor Telepon:</strong> &nbsp; {{ Auth::user()->siswa->no_telpon ?? 'Belum diisi' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection