@extends('layouts.app')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Pembimbing table</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            <a href="{{ route('admin.pembimbings.create') }}" class="btn btn-primary mb-3">Tambah Pembimbing</a>

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
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created-at</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $pembimbings)
                        <tr>
                            <td class="text-center align-middle text-sm">{{ $pembimbings->name }}</td>
                            <td class="text-center align-middle text-left text-sm">{{ $pembimbings->email }}</td>
                            <td class="text-center align-middle text-center text-sm">{{ $pembimbings->created_at->format('d-m-Y H:i') }}</td>
                            <td class="text-center align-middle">
                                <form action="{{ route('admin.pembimbings.delete', $pembimbings->id) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button style="position: relative; top: 7px;" type="submit" class="text-black font-weight-bold text-xs btn btn-primary" onclick="return confirm('Yakin ingin menghapus user ini?')" data-toggle="tooltip" data-original-title="Delete user">
                                        Hapus
                                    </button>
                                </form>
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