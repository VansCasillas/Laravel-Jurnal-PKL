@extends('layouts.app')

@section('title', 'Penilaian')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Penilaian table</h6>
            </div>
        </div>
        <div class="card-body px-3 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="penilaian">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">user</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">kelas</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">rata-rata nilai</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $pp)
                        <tr>
                            <td class="text-center align-middle text-sm">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle text-sm">{{ $pp->user->name }}</td>
                            <td class="text-center align-middle text-sm">{{ $pp->kelas->kelas }}</td>
                            <td class="text-center align-middle text-sm">{{ $pp->penilaians->avg('rata_rata') ?? '--' }}</td>
                            @php
                            $penilaian = $pp->penilaians->first();
                            @endphp
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a style="position: relative; top: 7px;" href="{{ route('pembimbingDudi.penilaian.form', ['siswa_id' => $pp->id]) }}" class="btn btn-primary btn-sm">Beri nilai</a>
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
        $('#penilaian').DataTable();
    });
</script>
@endsection