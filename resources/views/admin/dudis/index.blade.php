@extends('layouts.app')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Dudi table</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            <a href="{{ route('admin.dudi.create') }}" class="btn btn-primary mb-3">Tambah Dudi</a>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis usaha</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pimpinan</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pembimbing</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kontak</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dudis as $dudi)
                        <tr>
                            <td class="text-center align-middle text-sm">{{ $dudi->nama_dudi }}</td>
                            <td class="text-center align-middle text-sm">{{ $dudi->jenis_usaha }}</td>
                            <td class="text-center align-middle text-sm">{{ $dudi->alamat }}</td>
                            <td class="text-center align-middle text-sm">{{ $dudi->pimpinan }}</td>
                            <td class="text-center align-middle text-sm">{{ $dudi->pembimbing }}</td>
                            <td class="text-center align-middle text-sm">{{ $dudi->kontak }}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a style="position: relative; top: 7px;" href="{{ route('admin.dudi.edit', $dudi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.dudi.destroy', $dudi->id) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button style="position: relative; top: 7px;" type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
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
@endsection