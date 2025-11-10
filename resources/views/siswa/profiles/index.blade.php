@extends('layouts.app')

@section('title', 'Profile Siswa')

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
                        {{ Auth::user()->siswa->kelas->kelas ?? 'Belum ada kelas' }} - {{ Auth::user()->siswa->jurusan->jurusan ?? 'Belum ada jurusan' }}
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
                                            <strong>{{ Auth::user()->name }}</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                            <strong>{{ Auth::user()->email }}</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                            <strong>{{ Auth::user()->siswa->kelas->kelas }}</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jurusan</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                            <strong>{{ Auth::user()->siswa->jurusan->jurusan }}</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>NIS</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                            <strong>{{ Auth::user()->siswa->nis }}</strong>
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
                                        <strong>{{ Auth::user()->siswa->kelamin ?? 'Belum diisi' }}</strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tempat, tanggal lahir</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                        <strong>
                                            {{ Auth::user()->siswa->tempat ?? 'Belum diisi' }},
                                            {{ \Carbon\Carbon::parse(Auth::user()->siswa->tanggal_lahir)->format('d-m-Y') }}
                                        </strong>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                        <strong>{{ Auth::user()->siswa->no_telpon ?? 'Belum diisi' }}</strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Golongan darah</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                        <strong>{{ Auth::user()->siswa->gol_dar ?? 'Belum diisi' }}</strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                        <strong>{{ Auth::user()->siswa->alamat ?? 'Belum diisi' }}</strong>
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
                                        <h6 class="mb-0 text-sm">{{ Auth::user()->siswa->pembimbing->name ?? 'Belum diisi' }}</h6>
                                        <p class="mb-0 text-xs">{{ Auth::user()->siswa->pembimbing->email ?? 'Belum diisi' }}</p>
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
                                        <h6 class="mb-0 text-sm">{{ Auth::user()->siswa->dudi->pimpinan ?? 'Belum diisi' }}</h6>
                                        <p class="mb-0 text-xs">{{ Auth::user()->siswa->dudi->kontak ?? 'Belum diisi' }}</p>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex align-items-center px-0 pt-0">
                                    <div class="avatar me-3">
                                        <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                                    </div>
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ Auth::user()->siswa->dudi->pembimbing ?? 'Belum diisi' }}</h6>
                                        <p class="mb-0 text-xs">{{ Auth::user()->siswa->dudi->kontak ?? 'Belum diisi' }}</p>
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
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('siswa.profile.update', $profile->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileLabel">Edit Profil Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control styled-input" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="kelamin" class="form-control styled-input">
                                    <option value="">-- Pilih Jenis kelamin --</option>
                                    <option value="Laki-laki" {{ Auth::user()->siswa->kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ Auth::user()->siswa->kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat" value="{{ Auth::user()->siswa->tempat }}" class="form-control styled-input" placeholder="Belum diisi">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ Auth::user()->siswa->tanggal_lahir }}" class="form-control styled-input">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Golongan Darah</label>
                                <input type="text" name="gol_dar" value="{{ Auth::user()->siswa->gol_dar }}" class="form-control styled-input" placeholder="Belum diisi">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No Telepon</label>
                                <input type="text" name="no_telpon" value="{{ Auth::user()->siswa->no_telpon }}" class="form-control styled-input" placeholder="Belum diisi">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control styled-input" rows="2" placeholder="Belum diisi">{{ Auth::user()->siswa->alamat }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kelas</label>
                                <select name="id_kelas" class="form-control styled-input">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ Auth::user()->siswa->id_kelas == $k->id ? 'selected' : '' }}>{{ $k->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jurusan</label>
                                <select name="id_jurusan" class="form-control styled-input">
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach ($jurusan as $j)
                                    <option value="{{ $j->id }}" {{ Auth::user()->siswa->id_jurusan == $j->id ? 'selected' : '' }}>{{ $j->jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pembimbing</label>
                                <select name="id_pembimbing" class="form-control styled-input">
                                    <option value="">-- Pilih Nama Pembimbing --</option>
                                    @foreach ($pembimbing as $p)
                                    <option value="{{ $p->id }}" {{ Auth::user()->siswa->id_pembimbing == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">DUDI</label>
                                <select name="id_dudi" class="form-control styled-input">
                                    <option value="">-- Pilih Tempat PKL --</option>
                                    @foreach ($dudi as $d)
                                    <option value="{{ $d->id }}" {{ Auth::user()->siswa->id_dudi == $d->id ? 'selected' : '' }}>{{ $d->nama_dudi }}</option>
                                    @endforeach
                                </select>
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
</style>
@endsection