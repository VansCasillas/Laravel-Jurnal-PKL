<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function absensiAdmin(Request $request)
    {
        $absensi = Absensi::with('siswa')->get();
        return view('admin.absensis.absensi', compact('absensi'));
    }

    public function absensiPembimbing(Request $request)
    {
        $absensi = Absensi::with('siswa')->get();
        return view('pembimbing.absensis.absensi', compact('absensi'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Auth::user()->siswa;

        $absensi = Absensi::where('id_siswa', $siswa->id)
            ->select('tanggal_absen', 'status', 'jam_mulai', 'jam_selesai', 'keterangan')
            ->get()
            ->map(function ($item) {
                $warna = match ($item->status) {
                    'Hadir' => '#28a745',
                    'Izin' => '#007bff',
                    'Sakit' => '#dc3545',
                    'Libur' => '#e5ff00ff',
                    'Alpa' => '#6f42c1',
                    default => '#6c757d',
                };


                return [
                    'tanggal_absen' => Carbon::parse($item->tanggal_absen)->format('Y-m-d'),
                    'status' => $item->status,
                    'jam_mulai' => $item->jam_mulai ? Carbon::parse($item->jam_mulai)->format('H:i') : null,
                    'jam_selesai' => $item->jam_selesai ? Carbon::parse($item->jam_selesai)->format('H:i') : null,
                    'keterangan' => $item->keterangan,
                    'warna' => $warna,
                ];
            });

        return view("siswa.absensis.index", [
            'absensi' => $absensi
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_absen' => 'required|date',
            'status' => 'required|in:Hadir,Izin,Sakit,Libur',
            'jam_mulai' => 'nullable|date_format:H:i',
            'jam_selesai' => 'nullable|date_format:H:i',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $siswa = Auth::user()->siswa;
        $today = Carbon::today();

        // Cek absen terakhir siswa
        $lastAbsen = Absensi::where('id_siswa', $siswa->id)
            ->orderBy('tanggal_absen', 'desc')
            ->first();

        // Tambahkan otomatis status "Alpa" untuk hari-hari di antara absen terakhir dan hari ini
        if ($lastAbsen) {
            $nextDate = Carbon::parse($lastAbsen->tanggal_absen)->addDay();

            while ($nextDate->lt($today)) {
                // Lewati Sabtu dan Minggu
                if (!in_array($nextDate->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                    // Cek kalau belum ada absen di tanggal tsb
                    $cek = Absensi::where('id_siswa', $siswa->id)
                        ->whereDate('tanggal_absen', $nextDate)
                        ->first();

                    if (!$cek) {
                        Absensi::create([
                            'id_siswa' => $siswa->id,
                            'tanggal_absen' => $nextDate->toDateString(),
                            'status' => 'Alpa',
                            'keterangan' => 'Tanpa keterangan',
                        ]);
                    }
                }

                $nextDate->addDay();
            }
        } else {
            // Kalau belum pernah absen sama sekali, isi otomatis semua hari sebelumnya sebagai Alpa
            $startDate = Carbon::parse($siswa->created_at)->startOfDay();
            $loopDate = $startDate->copy();

            while ($loopDate->lt($today)) {
                if (!in_array($loopDate->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                    Absensi::create([
                        'id_siswa' => $siswa->id,
                        'tanggal_absen' => $loopDate->toDateString(),
                        'status' => 'Alpa',
                        'keterangan' => 'Tanpa keterangan',
                    ]);
                }
                $loopDate->addDay();
            }
        }

        // Cek apakah sudah absen di tanggal ini
        $absen = Absensi::where('id_siswa', $siswa->id)
            ->whereDate('tanggal_absen', $request->tanggal_absen)
            ->first();

        $data = [
            'status' => $request->status,
            'jam_mulai' => $request->status === 'Hadir' ? $request->jam_mulai : null,
            'jam_selesai' => $request->status === 'Hadir' ? $request->jam_selesai : null,
            'keterangan' => in_array($request->status, ['Izin', 'Sakit', 'Libur'])
                ? ($request->keterangan ?: '-')
                : null,
        ];

        if ($absen) {
            $absen->update($data);
        } else {
            Absensi::create(array_merge($data, [
                'id_siswa' => $siswa->id,
                'tanggal_absen' => $request->tanggal_absen,
            ]));
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
