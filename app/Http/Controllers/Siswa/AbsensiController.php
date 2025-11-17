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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Auth::user()->siswa;

        $absensi = Absensi::where('id_siswa', $siswa->id)
            ->select('id','tanggal_absen', 'status', 'jam_mulai', 'jam_selesai', 'keterangan')
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
                    'id' => $item->id,
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
            'status' => 'required|in:Hadir,Izin,Sakit,Libur',
            'keterangan' => 'required_if:status,Sakit,Izin,Libur',
        ]);

        $siswa = Auth::user()->siswa;
        $today = Carbon::today();

        // Cek apakah sudah absen di tanggal ini
        if (Absensi::where('id_siswa', $siswa->id)->where('tanggal_absen', $today)->exists()) {
            return back()->with('error', 'Siswa sudah absen hari ini.');
        }

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
                    Absensi::create([
                        'id_siswa' => $siswa->id,
                        'tanggal_absen' => $nextDate->toDateString(),
                        'status' => 'Alpa',
                        'keterangan' => 'Tanpa keterangan',
                    ]);
                }

                $nextDate->addDay();
            }
        }

        Absensi::create([
            'id_siswa' => $siswa->id,
            'tanggal_absen'=> $today,
            'jam_mulai' => $request->status == 'Hadir' ? now()->format('H:i:s') : null,
            'status' => $request->status,
            'keterangan' => $request->status == 'Hadir' ? null : $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
    }

    public function absenPulang($id)
    {
        $absensi = Absensi::findOrFail($id);

        if ($absensi->status !== 'Hadir') {
            return back()->with('error', 'Absen Pulang Hanya Untuk Siswa yg Hadir');
        }
        if ($absensi->jam_selesai !== null) {
            return back()->with('error', 'Udah Absen Sebelumnya');
        }
        $absensi->update([
            'jam_selesai' => now()->format('H:i:s'),
        ]);

        return back()->with('success', 'Absen Pulag Berhasil');
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
