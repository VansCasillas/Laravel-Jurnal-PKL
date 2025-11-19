@extends('layouts.app')

@section('title', 'Penilaian')

@section('content')
<div class="col-12">
    <div class="card my-4">

        <div class="card-header bg-gradient-dark text-white px-3 py-3">
            <h5 class="mb-0">
                Penilaian - {{ $siswa->user->name }}
                ({{ $penilaian ? 'Edit' : 'Beri Nilai' }})
            </h5>
        </div>

        <div class="card-body px-4">

            <form action="{{ route('pembimbingDudi.penilaian.save') }}" method="POST">
                @csrf

                <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

                <h6 class="mt-4 mb-2 fw-bold">Softskill</h6>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Aspek</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($softskills as $s)
                        @php
                        $nilai = $penilaian->softskill_data[$s->id]['nilai'] ?? '';
                        @endphp
                        <tr>
                            <td>{{ $s->aspek_penilaian }}</td>
                            <td>
                                <input type="number" name="soft_{{ $s->id }}" class="form-control" value="{{ $nilai }}"
                                    min="0" max="100" required>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h6 class="mt-4 mb-2 fw-bold">Hardskill</h6>

                <table class="table table-bordered" id="hardskillTable">
                    <thead>
                        <tr>
                            <th>Aspek Penilaian</th>
                            <th>Nilai</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                        // Decode JSON ke array
                        $hardskills = [];

                        if ($penilaian && !empty($penilaian->hardskill_data)) {

                        // Jika sudah cast jadi array oleh model → langsung pakai
                        if (is_array($penilaian->hardskill_data)) {
                        $hardskills = $penilaian->hardskill_data;
                        }

                        // Jika masih string JSON → decode manual
                        else {
                        $decoded = json_decode($penilaian->hardskill_data, true);
                        $hardskills = is_array($decoded) ? $decoded : [];
                        }
                        }
                        @endphp

                        @foreach($hardskills as $h)
                        <tr>
                            <td>
                                <input type="text" name="hardskill_aspek[]" class="form-control"
                                    value="{{ $h['aspek'] ?? '' }}" required>
                            </td>

                            <td>
                                <input type="number" name="hardskill_nilai[]" class="form-control"
                                    value="{{ $h['nilai'] ?? '' }}" min="0" max="100" required>
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">X</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="button" class="btn btn-secondary mb-3" onclick="addHardskill()">+ Tambah
                    Hardskill</button>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        Simpan Penilaian
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    function addHardskill() {
        let table = document.querySelector('#hardskillTable tbody');
        table.insertAdjacentHTML('beforeend', `
                        <tr>
                            <td><input type="text" class="form-control" name="hardskill_aspek[]" required></td>
                            <td><input type="number" class="form-control" name="hardskill_nilai[]" min="0" max="100" required></td>
                            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">X</button></td>
                        </tr>
                    `);
    }

    function removeRow(btn) {
        btn.closest('tr').remove();
    }
</script>
@endsection