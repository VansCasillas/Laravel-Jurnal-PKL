@extends('layouts.app')

@section('title', 'Absensi Siswa')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                    <button class="btn btn-outline-light" id="prevMonth"><i class="material-symbols-rounded">arrow_back_ios</i></button>
                    <h5 class="mb-0 text-white" id="monthTitle"></h5>
                    <button class="btn btn-outline-light" id="nextMonth"><i class="material-symbols-rounded">arrow_forward_ios</i></button>
                </div>

                <div class="card-body">
                    <div class="calendar-container mb-4">
                        <div class="calendar-header">
                            <div class="day-header">Minggu</div>
                            <div class="day-header">Senin</div>
                            <div class="day-header">Selasa</div>
                            <div class="day-header">Rabu</div>
                            <div class="day-header">Kamis</div>
                            <div class="day-header">Jum'at</div>
                            <div class="day-header">Sabtu</div>
                        </div>
                        <div class="calendar-body" id="calendarDays"></div>
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
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="absenModalLabel">Isi Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('siswa.absensi.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="tanggal" id="selectedDate">
                    <p class="mb-3">Tanggal: <span id="tanggalDisplay" class="fw-bold text-primary"></span></p>

                    <!-- Status -->
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="status" id="hadir" value="Hadir" required>
                        <label class="form-check-label fw-bold" for="hadir">Hadir</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="status" id="izin" value="Izin">
                        <label class="form-check-label fw-bold" for="izin">Izin</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="status" id="sakit" value="Sakit">
                        <label class="form-check-label fw-bold" for="sakit">Sakit</label>
                    </div>

                    <!-- Box Hadir -->
                    <div id="hadirBox" class="mt-3" style="display: none;">
                        <label for="jam_mulai" class="form-label">Jam Mulai:</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="form-control mb-2 border px-2">

                        <label for="jam_selesai" class="form-label">Jam Selesai:</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" class="form-control border px-2">
                    </div>

                    <!-- Box Izin/Sakit -->
                    <div id="keteranganBox" class="mt-3" style="display: none;">
                        <label for="keterangan" class="form-label">Keterangan:</label>
                        <textarea name="keterangan" id="keterangan" class="form-control border px-2" rows="3" placeholder="Tulis alasan..."></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark">Simpan</button>
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
        padding: 10px;
        text-align: center;
        font-weight: 600;
        color: #495057;
    }
    .calendar-body {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
    }
    .calendar-day {
        min-height: 90px;
        padding: 6px;
        border-right: 1px solid #e0e0e0;
        border-bottom: 1px solid #e0e0e0;
        text-align: left;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .calendar-day:hover { background-color: #f1f1f1; }
    .calendar-day.other-month {
        background-color: #f8f9fa;
        color: #adb5bd;
    }
    .calendar-day:nth-child(7n) { border-right: none; }
    .calendar-day.today {
        background-color: #0d6efd !important;
        color: #fff !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarDays = document.getElementById('calendarDays');
    const monthTitle = document.getElementById('monthTitle');
    const radios = document.querySelectorAll('input[name="status"]');
    const hadirBox = document.getElementById('hadirBox');
    const keteranganBox = document.getElementById('keteranganBox');
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');

    let currentMonth = new Date().getMonth() + 1;
    let currentYear = new Date().getFullYear();

    function renderCalendar(month, year) {
        calendarDays.innerHTML = '';
        monthTitle.textContent = new Date(year, month - 1).toLocaleString('id-ID', {
            month: 'long', year: 'numeric'
        });

        const firstDay = new Date(year, month - 1, 1);
        const lastDay = new Date(year, month, 0);
        const startDay = firstDay.getDay();
        const monthLength = lastDay.getDate();
        const prevMonthLastDate = new Date(year, month - 1, 0).getDate();
        const today = new Date();

        for (let i = 0; i < startDay; i++) {
            const day = document.createElement('div');
            day.className = 'calendar-day other-month';
            day.innerHTML = `<div class="day-number">${prevMonthLastDate - startDay + i + 1}</div>`;
            calendarDays.appendChild(day);
        }

        for (let i = 1; i <= monthLength; i++) {
            const day = document.createElement('div');
            const dateStr = `${year}-${String(month).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            day.className = 'calendar-day';
            day.innerHTML = `<div class="day-number">${i}</div>`;

            if (today.getDate() === i && today.getMonth() + 1 === month && today.getFullYear() === year) {
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
        const filledCells = startDay + monthLength;
        const nextMonthDays = totalCells - filledCells;

        for (let i = 1; i <= nextMonthDays; i++) {
            const day = document.createElement('div');
            day.className = 'calendar-day other-month';
            day.innerHTML = `<div class="day-number">${i}</div>`;
            calendarDays.appendChild(day);
        }
    }

    radios.forEach(radio => {
        radio.addEventListener('change', () => {
            if (radio.id === 'hadir') {
                hadirBox.style.display = 'block';
                keteranganBox.style.display = 'block';
            } else if (radio.id === 'izin' || radio.id === 'sakit') {
                hadirBox.style.display = 'none';
                keteranganBox.style.display = 'block';
            } else {
                hadirBox.style.display = 'none';
                keteranganBox.style.display = 'none';
            }
        });
    });

    prevMonthBtn.addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 1) {
            currentMonth = 12; currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    nextMonthBtn.addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 12) {
            currentMonth = 1; currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    });

    renderCalendar(currentMonth, currentYear);
});
</script>
@endsection
