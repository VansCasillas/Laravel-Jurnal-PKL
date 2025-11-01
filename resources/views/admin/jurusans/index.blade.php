@extends('layouts.app')

@section('title', 'Kelola Jurusan')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Kelas Jurusan</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary mb-3">Tambah Jurusan</a>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
        <div class="card-body px-3 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="jurusan">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created-at</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurusans as $item)
                        <tr>
                            <td class="text-center text-sm">{{ $item->jurusan }}</td>
                            <td class="text-center align-middle text-center text-sm">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                            <td class="text-center align-middle" width="30%">
                                <div class="d-flex justify-content-center gap-2">
                                    <a style="position: relative; top: 7px;" href="{{ route('admin.jurusan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.jurusan.destroy', $item->id) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
<script>
    $(document).ready(function() {
        $('#jurusan').DataTable();
    });
</script>
@endsection