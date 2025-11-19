@extends('layouts.app')

@section('title', 'Profile Siswa')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-dark  opacity-6"></span>
    </div>
    <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row gx-3 mb-2 px-3">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ optional($profile)->foto_profil && file_exists(storage_path('app/public/' . $profile->foto_profil)) 
                                ? asset('storage/' . $profile->foto_profil) 
                                : asset('assets/img/kal-visuals-square.jpg') }}" alt="kal" style="object-fit: cover;" class="border-radius-lg shadow">
                </div>
            </div>
            <div class="col-auto my-2">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ optional(optional($profile)->user)->name ?? 'belum diisi' }}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        {{ optional(optional($profile)->kelas)->kelas ?? 'Belum ada kelas' }} - {{ optional(optional($profile)->jurusan)->jurusan ?? 'Belum ada jurusan' }}
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
                                <!-- <div class="col-md-4 text-end">
                                    <a href="javascript:;">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                            <strong>{{ optional(optional($profile)->user)->name ?? 'belum diisi' }}</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                            <strong>{{ optional(optional($profile)->user)->email ?? 'belum diisi' }}</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                            <strong>{{ $profile->kelas->kelas ?? 'belum kelas' }}</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jurusan</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                            <strong>{{ $profile->jurusan->jurusan ?? 'belum ada jurusan' }}</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>NIS</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                            <strong>{{ optional($profile)->nis ?? 'belum diisi' }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0" style="visibility: hidden;">Profile Information</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <div class="form-group">
                                    <label>Kelamin</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                        <strong>{{ optional($profile)->kelamin ?? 'Belum diisi' }}</strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tempat, tanggal lahir</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                        <strong>
                                            {{ optional($profile)->tempat ?? '--' }},
                                            {{ optional($profile)->tanggal_lahir ? \Carbon\Carbon::parse(optional($profile)->tanggal_lahir)->format('d-F-Y') : '--' }}
                                        </strong>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                        <strong>{{ optional($profile)->no_telpon ?? 'Belum diisi' }}</strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Golongan darah</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                        <strong>{{ optional($profile)->gol_dar ?? 'Belum diisi' }}</strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                        <strong>{{ optional($profile)->alamat ?? 'Belum diisi' }}</strong>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-body">
                            <div class="card-header">
                                <h6 class="mb-0">Guru Pembimbing</h6>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex align-items-center px-0 pt-0">
                                    <div class="avatar me-3">
                                        <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $profile->pembimbing->name ?? 'Belum diisi' }}</h6>
                                        <p class="mb-0 text-xs">{{ $profile->pembimbing->email ?? 'Belum diisi' }}</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="card-header">
                                <h6 class="mb-0">Pembimbing PKL</h6>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex align-items-center px-0 pt-0">
                                    <div class="avatar me-3">
                                        <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $profile->dudi->pimpinan ?? 'Belum diisi' }}</h6>
                                        <p class="mb-0 text-xs">{{ $profile->dudi->kontak ?? 'Belum diisi' }}</p>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex align-items-center px-0 pt-0">
                                    <div class="avatar me-3">
                                        <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $profile->dudi->pembimbing ?? 'Belum diisi' }}</h6>
                                        <p class="mb-0 text-xs">{{ $profile->dudi->kontak ?? 'Belum diisi' }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 mt-3 mb-3 w-full d-flex justify-content-center ">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Ubah
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('siswa.profile.update', optional($profile)->id ?? 0) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileLabel">Edit Profil Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="profile-pic-wrapper">
                            <img id="previewImage"
                                src="{{ optional($profile)->foto_profil && file_exists(storage_path('app/public/' . $profile->foto_profil)) 
                                ? asset('storage/' . $profile->foto_profil) 
                                : asset('assets/img/kal-visuals-square.jpg') }}"
                                alt="Foto Profil"
                                class="profile-pic">
                            <button type="button" class="edit-btn" onclick="document.getElementById('fotoInput').click()">Edit</button>
                            <input type="file" id="fotoInput" name="foto_profil" class="hidden-input" accept="image/*" onchange="previewImage(event)">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ optional(optional($profile)->user)->name }}" class="form-control styled-input" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="kelamin" class="form-control styled-input">
                                    <option value="">-- Pilih Jenis kelamin --</option>
                                    <option value="Laki-laki" {{ optional($profile)->kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ optional($profile)->kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat" value="{{ optional($profile)->tempat }}" class="form-control styled-input" placeholder="Belum diisi">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ optional($profile)->tanggal_lahir }}" class="form-control styled-input">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Golongan Darah</label>
                                <input type="text" name="gol_dar" value="{{ optional($profile)->gol_dar }}" class="form-control styled-input" placeholder="Belum diisi">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No Telepon</label>
                                <input type="text" name="no_telpon" value="{{ optional($profile)->no_telpon }}" class="form-control styled-input" placeholder="Belum diisi">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <input name="email" type="email" class="form-control styled-input" rows="2" placeholder="Belum diisi" value="{{ optional(optional($profile)->user)->email }}">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Password</label>
                                <input name="password" type="password" class="form-control styled-input" rows="2" placeholder="">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control styled-input" rows="2" placeholder="Belum diisi">{{ optional($profile)->alamat }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    /* 🔹 Styling input biar kotaknya jelas */
    .styled-input {
        border: 1.5px solid #bbb;
        border-radius: 8px;
        padding: 10px 12px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .styled-input:focus {
        border-color: #000;
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
        outline: none;
    }

    label {
        margin-bottom: 6px;
    }

    .profile-pic-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 1rem;
        position: relative;
    }

    .profile-pic {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ddd;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .edit-btn {
        position: absolute;
        bottom: 5px;
        right: 150px;
        background-color: #0d6efd;
        border: none;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: 0.2s;
    }

    .edit-btn:hover {
        background-color: #0b5ed7;
    }

    .hidden-input {
        display: none;
    }
</style>
@endsection