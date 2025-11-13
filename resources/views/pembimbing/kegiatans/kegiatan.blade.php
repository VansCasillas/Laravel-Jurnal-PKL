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
                            <td class="text-center align-middle text-sm">{{ Str::limit($k->kegiatan, 50, '...') }}</td>
                            <td class="text-center d-flex align-middle gap-2">
                                <a style="position: relative; top: 7px;" href="{{ route('pembimbing.detail', $k->id) }}" class="btn btn-info">detail</a>
                                <!-- Button trigger modal -->
                                <button style="position: relative; top: 7px;" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $k->id }}">
                                    Tambah Komentar
                                </button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop{{ $k->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="{{ route('pembimbing.komentar', $k->id) }}" method="POST">
                                            @csrf

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editProfileLabel">Tambahkan Catatan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <label class="form-label">Catatan</label>
                                                    <textarea type="text" name="catatan_pembimbing" class="form-control styled-input" required rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
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
<script>
    $(document).ready(function() {
        $('#kegiatan').DataTable();
    });
</script>
@endsection