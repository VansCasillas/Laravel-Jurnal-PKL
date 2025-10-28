@extends('layouts.app')

@section('title', 'Absensi Siswa')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Kalender -->
        <div class="col-lg-8 col-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                    <button class="btn btn-outline-light" id="prevMonth">
                        <i class="material-symbols-rounded">arrow_back_ios</i>
                    </button>
                    <h5 class="mb-0 text-white" id="monthTitle"></h5>
                    <button class="btn btn-outline-light" id="nextMonth">
                        <i class="material-symbols-rounded">arrow_forward_ios</i>
                    </button>
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

        <!-- Form Absensi -->
        <div class="col-lg-4 col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    Detail Absensi
                </div>
                <div class="card-body">
                    <form action="{{ route('siswa.absensi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tanggal_absen" id="selectedDate">
                        <p>Tanggal: <span id="tanggalDisplay" class="fw-bold text-primary">-</span></p>

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

                        <div id="hadirBox" class="mt-3" style="display: none;">
                            <label for="jam_mulai" class="form-label">Jam Mulai:</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control mb-2 border px-2">
                            <label for="jam_selesai" class="form-label">Jam Selesai:</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control border px-2">
                        </div>

                        <div id="keteranganBox" class="mt-3" style="display: none;">
                            <label for="keterangan" class="form-label">Keterangan:</label>
                            <textarea name="keterangan" id="keterangan" class="form-control border px-2" rows="3" placeholder="Tulis alasan..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-dark mt-3 w-100">Simpan</button>
                    </form>
                </div>
            </div>
            <!-- Card Status Hari Ini -->
            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📅 Status Absensi Hari Ini</h5>
                </div>
                <div class="card-body" id="statusCard">
                    <p class="text-muted mb-0">Belum ada data absensi untuk tanggal ini.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Kalender */
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
        position: relative;
    }

    .calendar-day:hover {
        background-color: #f1f1f1;
    }

    .calendar-day.other-month {
        background-color: #f8f9fa;
        color: #adb5bd;
    }

    .calendar-day:nth-child(7n) {
        border-right: none;
    }

    .calendar-day.today {
        background-color: #0d6efd !important;
        color: #fff !important;
    }

    .badge {
        position: absolute;
        top: 4px;
        right: 4px;
        font-size: 0.75rem;
        padding: 4px 6px;
        border-radius: 4px;
        color: #fff;
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

        const absensiData = @json($absensi ?? []);

        let currentMonth = new Date().getMonth() + 1;
        let currentYear = new Date().getFullYear();

        function renderCalendar(month, year) {
            calendarDays.innerHTML = '';
            monthTitle.textContent = new Date(year, month - 1).toLocaleString('id-ID', {
                month: 'long',
                year: 'numeric'
            });

            const firstDay = new Date(year, month - 1, 1);
            const lastDay = new Date(year, month, 0);
            const startDay = firstDay.getDay();
            const monthLength = lastDay.getDate();
            const prevMonthLastDate = new Date(year, month - 1, 0).getDate();
            const today = new Date();

            // prev month
            for (let i = 0; i < startDay; i++) {
                const day = document.createElement('div');
                day.className = 'calendar-day other-month';
                day.innerHTML = `<div class="day-number">${prevMonthLastDate-startDay+i+1}</div>`;
                calendarDays.appendChild(day);
            }

            // current month
            for (let i = 1; i <= monthLength; i++) {
                const day = document.createElement('div');
                const dateStr = `${year}-${String(month).padStart(2,'0')}-${String(i).padStart(2,'0')}`;
                day.className = 'calendar-day';
                day.innerHTML = `<div class="day-number">${i}</div>`;

                const absen = absensiData.find(a => a.tanggal_absen === dateStr);
                if (absen) {
                    day.innerHTML += `<span class="badge" style="background-color:${absen.warna}">${absen.status}</span>`;
                }

                if (today.getDate() === i && today.getMonth() + 1 === month && today.getFullYear() === year) {
                    day.classList.add('today');
                }

                day.addEventListener('click', function() {
                    document.getElementById('selectedDate').value = dateStr;
                    document.getElementById('tanggalDisplay').textContent = dateStr;

                    const absen = absensiData.find(a => a.tanggal_absen === dateStr);

                    if (absen) {
                        document.getElementById('hadir').checked = absen.status === 'Hadir';
                        document.getElementById('izin').checked = absen.status === 'Izin';
                        document.getElementById('sakit').checked = absen.status === 'Sakit';
                        hadirBox.style.display = absen.status === 'Hadir' ? 'block' : 'none';
                        keteranganBox.style.display = (absen.status === 'Izin' || absen.status === 'Sakit' || absen.status === 'Hadir') ? 'block' : 'none';
                        document.getElementById('jam_mulai').value = absen.jam_mulai || '';
                        document.getElementById('jam_selesai').value = absen.jam_selesai || '';
                        document.getElementById('keterangan').value = absen.keterangan || '';
                    } else {
                        radios.forEach(r => r.checked = false);
                        hadirBox.style.display = 'none';
                        keteranganBox.style.display = 'none';
                        document.getElementById('jam_mulai').value = '';
                        document.getElementById('jam_selesai').value = '';
                        document.getElementById('keterangan').value = '';
                    }
                });

                calendarDays.appendChild(day);
            }

            // next month
            const totalCells = 35;
            const nextDays = totalCells - (startDay + monthLength);
            for (let i = 1; i <= nextDays; i++) {
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
                currentMonth = 12;
                currentYear--;
            }
            renderCalendar(currentMonth, currentYear);
        });
        nextMonthBtn.addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 12) {
                currentMonth = 1;
                currentYear++;
            }
            renderCalendar(currentMonth, currentYear);
        });

        renderCalendar(currentMonth, currentYear);

        // === Set default ke hari ini ===
        // === Set default ke hari ini ===
        const today = new Date();
        const todayStr = today.toISOString().split('T')[0];
        document.getElementById('selectedDate').value = todayStr;
        document.getElementById('tanggalDisplay').textContent = todayStr;

        const statusInfo = document.getElementById('statusInfo');
        const todayAbsen = absensiData.find(a => a.tanggal_absen === todayStr);

        if (todayAbsen) {
            // Sudah isi absensi
            statusInfo.innerHTML = `✅ Kamu sudah mengisi absensi hari ini (${todayAbsen.status})`;
            statusInfo.classList.remove('text-danger');
            statusInfo.classList.add('text-success');

            document.getElementById('hadir').checked = todayAbsen.status === 'Hadir';
            document.getElementById('izin').checked = todayAbsen.status === 'Izin';
            document.getElementById('sakit').checked = todayAbsen.status === 'Sakit';

            // Tampilkan box sesuai status
            if (todayAbsen.status === 'Hadir') {
                document.getElementById('hadirBox').style.display = 'block';
                document.getElementById('keteranganBox').style.display = 'block';
            } else if (todayAbsen.status === 'Izin' || todayAbsen.status === 'Sakit') {
                document.getElementById('hadirBox').style.display = 'none';
                document.getElementById('keteranganBox').style.display = 'block';
            } else {
                document.getElementById('hadirBox').style.display = 'none';
                document.getElementById('keteranganBox').style.display = 'none';
            }

            document.getElementById('jam_mulai').value = todayAbsen.jam_mulai || '';
            document.getElementById('jam_selesai').value = todayAbsen.jam_selesai || '';
            document.getElementById('keterangan').value = todayAbsen.keterangan || '';

        } else {
            // Belum isi absensi
            statusInfo.innerHTML = `❌ Kamu belum mengisi absensi hari ini`;
            statusInfo.classList.remove('text-success');
            statusInfo.classList.add('text-danger');
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        const absensiData = @json($absensi);
        const statusCard = document.getElementById('statusCard');
        const selectedDateInput = document.getElementById('selectedDate');
        const tanggalDisplay = document.getElementById('tanggalDisplay');

        // Fungsi untuk menampilkan status absensi pada card
        function updateStatusCard(tanggal) {
            const data = absensiData.find(a => a.tanggal_absen === tanggal);

            if (data) {
                let jamInfo = '';
                if (data.status === 'Hadir') {
                    jamInfo = `
                    <p><strong>Jam:</strong> ${data.jam_mulai ?? '-'} - ${data.jam_selesai ?? '-'}</p>
                `;
                }

                let keteranganInfo = '';
                if (data.keterangan) {
                    keteranganInfo = `<p><strong>Keterangan:</strong> ${data.keterangan}</p>`;
                } else if (['Sakit', 'Izin'].includes(data.status)) {
                    keteranganInfo = `<p class="text-danger"><strong>Keterangan:</strong> Tidak diisi (Wajib diisi)</p>`;
                }

                statusCard.innerHTML = `
                <p><strong>Status:</strong> 
                    <span class="badge" style="background-color: ${data.warna};">
                        ${data.status}
                    </span>
                </p>
                ${jamInfo}
                ${keteranganInfo}
            `;
            } else {
                statusCard.innerHTML = `
                <p class="text-muted mb-0">❌ Belum ada absensi untuk tanggal ini.</p>
            `;
            }
        }

        // Saat halaman pertama kali dibuka → tampilkan status hari ini
        const today = new Date().toISOString().split('T')[0];
        selectedDateInput.value = today;
        tanggalDisplay.textContent = today;
        updateStatusCard(today);

        // Saat klik tanggal lain di kalender (atau tombol lain)
        document.querySelectorAll('.calendar-cell').forEach(cell => {
            cell.addEventListener('click', function() {
                const selectedDate = this.dataset.date;
                selectedDateInput.value = selectedDate;
                tanggalDisplay.textContent = selectedDate;
                updateStatusCard(selectedDate);
            });
        });
    });
</script>
@endsection