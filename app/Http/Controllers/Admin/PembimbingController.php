<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PembimbingController extends Controller
{
    //list user
    public function index()
    {
        $users = User::where('role', 'pembimbing')->get();

        return view('admin.pembimbings.index', compact('users'));
    }

    public function siswaP() {
        $siswas = Siswa::where('id_pembimbing', Auth::user()->id)->get();

        return view('pembimbing.siswas.index', compact('siswas'));
    }

    public function siswaAbsenP($id) {
        $siswaId = Siswa::where('id',$id)->where('id_pembimbing', Auth::user()->id)->first();
        if (!$siswaId) {
            abort(403, 'Anda tidak memiliki akses untuk melihat Absensi siswa ini');
        }
        $siswa = Siswa::findOrFail($id);
        $absens = Absensi::where('id_siswa',$id)->get();

        return view('pembimbing.siswas.absen', compact('absens', 'siswa'));
    }

    public function siswaKegiatanP($id) {
        $siswaId = Siswa::where('id',$id)->where('id_pembimbing', Auth::user()->id)->first();
        if (!$siswaId) {
            abort(403, 'Anda tidak memiliki akses untuk melihat kegiatan siswa ini');
        }
        $siswa = Siswa::findOrFail($id);
        $kegiatans = Kegiatan::where('id_siswa',$id)->get();

        return view('pembimbing.siswas.kegiatan', compact('kegiatans', 'siswa'));
    }

    //Form tambah user
    public function create()
    {
        return view('admin.pembimbings.create');
    }

    //Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Simpan ke tabel users dulu
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pembimbing',
        ]);

        return redirect()->route('admin.pembimbing.index')->with('status', 'Data Pembimbing berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pembimbing = User::where('role', 'pembimbing')->findOrFail($id);
        return view('admin.pembimbings.edit', compact('pembimbing'));
    }

    public function update(Request $request, User $pembimbing)
    {
        // Update data user
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Jika password diisi, update juga
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pembimbing->update($data);

        return redirect()->route('admin.pembimbing.index')->with('success', 'Data Pembimbing berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.pembimbing.index')->with('success', 'Data Pembimbing berhasil dihapus.');
        }
        return redirect()->route('admin.pembimbing.index')->with('error', 'Data Pembimbing tidak ditemukan.');
    }
}
