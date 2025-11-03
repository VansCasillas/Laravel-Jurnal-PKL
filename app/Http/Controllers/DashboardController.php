<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Dudi;
use App\Models\Jurusan;
use App\Models\Kegiatan;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Total Siswa & pembimbing di Admin
        $totalSiswa = Siswa::count();
        $totalPembimbing = User::where('role', 'pembimbing')->count();


        $jurusan = Jurusan::count();
        $dudi = Dudi::count();
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.dashboard', compact('user','totalSiswa', 'totalPembimbing', 'jurusan','dudi'));
        } else if ($user->role === 'pembimbing') {
            return view('pembimbing.dashboard', compact('user'));
        } else if ($user->role === 'siswa') {
            
            // Total Absen & kegiatan
        $totalKegiatan = Kegiatan::where('id_siswa',Auth::user()->siswa->id)->count();
        $totalAbsen = Absensi::where('id_siswa',Auth::user()->siswa->id)->count();

            return view('siswa.dashboard', compact('totalAbsen', 'totalKegiatan'));
        } else {
            abort(403, 'Role pengguna tidak diketahui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
