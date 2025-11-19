<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Dudi;
use App\Models\Jurusan;
use App\Models\Kegiatan;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Total Siswa & pembimbing di Admin
            $totalSiswa = Siswa::count();
            $totalPembimbing = User::where('role', 'pembimbing')->count();

            $jurusan = Jurusan::count();
            $dudi = Dudi::count();

            return view('admin.dashboard', compact('user', 'totalSiswa', 'totalPembimbing', 'jurusan', 'dudi'));
        } else if ($user->role === 'pembimbing') {

            $totalSiswaP = Siswa::where('id_pembimbing', Auth::user()->id)->count();

            $siswaDibimbing = Siswa::where('id_pembimbing', Auth::user()->id)->get();
            $dudiSiswa = $siswaDibimbing->pluck('dudi')->unique('id');

            return view('pembimbing.dashboard', compact('user', 'siswaDibimbing', 'dudiSiswa', 'totalSiswaP'));
        } else if ($user->role === 'siswa') {

            $siswa = Auth::user()->siswa;
            $today = Carbon::today()->toDateString();

            if (!$siswa) {

                $absensiHariIni = null;
                $totalKegiatan = null;
                $totalAbsen = null;
                $kegiatans = collect();

                return view('siswa.dashboard', compact('totalAbsen', 'totalKegiatan', 'absensiHariIni', 'kegiatans'));
            }

            $absensiHariIni = Absensi::where('id_siswa', $siswa->id)
                ->whereDate('tanggal_absen', $today)
                ->first();
            // Total Absen & kegiatan
            $totalKegiatan = Kegiatan::where('id_siswa', Auth::user()->siswa->id)->count();
            $totalAbsen = Absensi::where('id_siswa', Auth::user()->siswa->id)->count();
            $kegiatans = Kegiatan::where('id_siswa', Auth::user()->siswa->id)->take(6)->orderBy('id', 'desc')->get();

            return view('siswa.dashboard', compact('totalAbsen', 'totalKegiatan', 'absensiHariIni', 'kegiatans'));
        } else {
            abort(403, 'Role pengguna tidak diketahui');
        }
    }

    public function pembimbingDudi() {
        return view('pembimbingDudi.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
