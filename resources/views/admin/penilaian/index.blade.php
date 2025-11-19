@extends('layouts.app')

@section('title', 'Penilaian Siswa')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Penilaian table</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary mb-3">Tambah Aspek Penilaian</a>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
        <div class="card-body px-3 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="dudi">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">kriteria</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">aspek penilaian</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created-at</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penilaian as $pp)
                        <tr>
                            <td class="text-center align-middle text-sm">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle text-sm">{{ $pp->kriteria }}</td>
                            <td class="text-center align-middle text-sm">{{ $pp->aspek_penilaian }}</td>
                            <td class="text-center align-middle text-sm">{{ $pp->created_at->format('d-m-Y H:i') }}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a style="position: relative; top: 7px;" href="{{ route('admin.dudi.edit', $pp->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.penilaian.destroy', $pp->id) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
        $('#dudi').DataTable();
    });
</script>
@endsection