@extends('layouts.app')

@section('title', 'Absensi Siswa')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark">
                    <h5 class="mb-0 text-white">Oktober 2025</h5>
                </div>
                <div class="card-body">

                    <!-- Calendar -->
                    <div class="calendar-container mb-4">
                        <div class="calendar-header">
                            <div class="day-header">Minggu</div>
                            <div class="day-header">Senin</div>
                            <div class="day-header">Selasa</div>
                            <div class="day-header">Rabu</div>
                            <div class="day-header">Kamis</div>
                            <div class="day-header">Jumat</div>
                            <div class="day-header">Sabtu</div>
                        </div>
                        <div class="calendar-body" id="calendarDays">
                            <!-- Kalender diisi dengan JS -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Absen -->
<div class="modal fade" id="absenModal" tabindex="-1" aria-labelledby="absenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="absenModalLabel">Isi Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="tanggal" id="selectedDate">
                    <p class="mb-3">Tanggal: <span id="tanggalDisplay" class="fw-bold text-primary"></span></p>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="status" id="hadir" value="Hadir" required>
                        <label class="form-check-label" for="hadir">Hadir</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="status" id="izin" value="Izin">
                        <label class="form-check-label" for="izin">Izin</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="status" id="sakit" value="Sakit">
                        <label class="form-check-label" for="sakit">Sakit</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="status" id="tanpa" value="Tanpa Keterangan">
                        <label class="form-check-label" for="tanpa">Tanpa Keterangan</label>
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

<style>
    .calendar-container {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
    }

    .calendar-header {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        background-color: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
    }

    .day-header {
        padding: 12px;
        text-align: center;
        font-weight: 600;
        color: #495057;
    }

    .calendar-body {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
    }

    .calendar-day {
        min-height: 100px;
        padding: 8px;
        border-right: 1px solid #e0e0e0;
        border-bottom: 1px solid #e0e0e0;
        text-align: left;
        position: relative;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .calendar-day:hover {
        background-color: #f8f9fa;
    }

    .calendar-day.other-month {
        background-color: #f8f9fa;
        color: #adb5bd;
        cursor: default;
    }

    .calendar-day:nth-child(7n) {
        border-right: none;
    }

    .day-number {
        font-weight: 600;
    }

    /* Hari ini (active) */
    .calendar-day.today {
        background-color: #0d6efd !important;
        color: #fff !important;
        border: 2px solid #084298;
    }

    .calendar-day.today .day-number {
        color: #fff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarDays = document.getElementById('calendarDays');
        const month = 9; // Oktober (index 9 karena Januari = 0)
        const year = 2025;

        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const startingDay = firstDay.getDay();
        const monthLength = lastDay.getDate();

        // Tanggal akhir bulan sebelumnya (September)
        const prevMonthLastDate = new Date(year, month, 0).getDate();

        // Tanggal hari ini (untuk highlight)
        const today = new Date();
        const isThisMonth = today.getMonth() === month && today.getFullYear() === year;

        // Tambah tanggal dari akhir September (sebelum 1 Oktober)
        for (let i = 0; i < startingDay; i++) {
            const day = document.createElement('div');
            day.className = 'calendar-day other-month';
            day.innerHTML = `<div class="day-number">${prevMonthLastDate - startingDay + i + 1}</div>`;
            calendarDays.appendChild(day);
        }

        // Tanggal bulan Oktober
        for (let i = 1; i <= monthLength; i++) {
            const day = document.createElement('div');
            const dateStr = `${year}-10-${String(i).padStart(2, '0')}`;
            day.className = 'calendar-day';
            day.innerHTML = `<div class="day-number">${i}</div>`;

            // Tandai hari ini
            if (isThisMonth && today.getDate() === i) {
                day.classList.add('today');
            }

            day.addEventListener('click', function() {
                document.getElementById('selectedDate').value = dateStr;
                document.getElementById('tanggalDisplay').textContent = dateStr;
                const modal = new bootstrap.Modal(document.getElementById('absenModal'));
                modal.show();
            });

            calendarDays.appendChild(day);
        }
        const totalCells = 35;
        const filledCells = startingDay + monthLength;
        const nextMonthDays = totalCells - filledCells;

        for (let i = 1; i <= nextMonthDays; i++) {
            const day = document.createElement('div');
            day.className = 'calendar-day other-month';
            day.innerHTML = `<div class="day-number">${i}</div>`;
            calendarDays.appendChild(day);
        }
    });
</script>
@endsection
