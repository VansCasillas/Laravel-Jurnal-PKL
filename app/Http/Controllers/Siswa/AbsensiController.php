<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Auth::user()->siswa;

        // Ambil semua absensi milik siswa yang login
        $absensi = Absensi::where('id_siswa', $siswa->id)
            ->select('tanggal_absen', 'status', 'jam_mulai', 'jam_selesai', 'keterangan')
            ->get()
            ->map(function ($item) {
                // Tentukan warna badge sesuai status
                $warna = match ($item->status) {
                    'Hadir' => '#28a745',
                    'Izin' => '#007bff',
                    'Sakit' => '#dc3545',
                    default => '#6c757d',
                };

                return [
                    'tanggal_absen' => $item->tanggal_absen->format('Y-m-d'),
                    'status' => $item->status,
                    'jam_mulai' => $item->jam_mulai,
                    'jam_selesai' => $item->jam_selesai,
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
            'status' => 'required|in:Hadir,Izin,Sakit',
            'jam_mulai' => 'nullable|date_format:H:i',
            'jam_selesai' => 'nullable|date_format:H:i',
            'keterangan' => 'nullable|string',
        ]);

        // Ambil user login (siswa)
        $siswa = Auth::user()->siswa;

        // Cek apakah sudah absen di tanggal itu
        $absen = Absensi::where('id_siswa', $siswa->id)
            ->whereDate('tanggal_absen', $request->tanggal_absen)
            ->first();

        // Jika sudah ada → update, kalau belum → buat baru
        if ($absen) {
            $absen->update([
                'status' => $request->status,
                'jam_mulai' => $request->status === 'Hadir' ? $request->jam_mulai : null,
                'jam_selesai' => $request->status === 'Hadir' ? $request->jam_selesai : null,
                'keterangan' => in_array($request->status, ['Izin', 'Sakit']) ? $request->keterangan : null,
            ]);
        } else {
            Absensi::create([
                'id_siswa' => $siswa->id,
                'tanggal_absen' => $request->tanggal_absen,
                'status' => $request->status,
                'jam_mulai' => $request->status === 'Hadir' ? $request->jam_mulai : null,
                'jam_selesai' => $request->status === 'Hadir' ? $request->jam_selesai : null,
                'keterangan' => in_array($request->status, ['Izin', 'Sakit']) ? $request->keterangan : null,
            ]);
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
