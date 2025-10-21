<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use App\Models\Jurusan;
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
        // Total Siswa
        $totalSiswa = User::where('role', 'siswa')->count();
        // Total Pembimbing
        $totalPembimbing = User::where('role', 'pembimbing')->count();
        $jurusan = Jurusan::count();
        $dudi = Dudi::count();
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.dashboard', compact('user','totalSiswa', 'totalPembimbing', 'jurusan','dudi'));
        } else if ($user->role === 'pembimbing') {
            return view('pembimbing.dashboard', compact('user'));
        } else if ($user->role === 'siswa') {
            return view('siswa.dashboard', compact('user'));
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
