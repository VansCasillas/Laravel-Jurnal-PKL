<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use App\Models\Jurusan;
use App\Models\Kegiatan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $profile = $user->siswa ? $user->siswa->load(['kelas', 'jurusan', 'dudi', 'pembimbing']) : null;

        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $dudi = Dudi::all();

        $pembimbing = User::where('role', 'pembimbing')->get();

        return view('siswa.profiles.index', compact('profile', 'kelas', 'jurusan', 'dudi', 'pembimbing'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // ambil siswa + relasi yg dibutuhkan
        $profile = Siswa::with(['user', 'kelas', 'jurusan', 'dudi', 'pembimbing'])->findOrFail($id);

        // ambil data dropdown
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $dudi = Dudi::all();
        $pembimbing = User::where('role', 'pembimbing')->get();

        // kirim ke view (pastikan view expecting $profile)
        return view('siswa.profiles.edit', compact('profile', 'kelas', 'jurusan', 'dudi', 'pembimbing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        $request->validate([
            'name' => 'required|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kelamin' => 'nullable|string',
            'tempat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'gol_dar' => 'nullable|string',
            'alamat' => 'nullable|string',
            'no_telpon' => 'nullable|string',
            'id_kelas' => 'required|integer',
            'id_jurusan' => 'required|integer',
            'id_pembimbing' => 'required|integer',
            'id_dudi' => 'required|integer',
        ]);

        $path = $siswa->foto_profil; // simpan path lama dulu

        if ($request->hasFile('foto_profil')) {
            // hapus foto lama
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            // upload baru
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        // update nama di tabel users
        $user->update(['name' => $request->name]);

        // update data siswa
        $siswa->update([
            'nama' => $request->name,
            'foto_profil' => $path, // ✅ gunakan path hasil upload
            'kelamin' => $request->kelamin,
            'tempat' => $request->tempat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'gol_dar' => $request->gol_dar,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
            'id_kelas' => $request->id_kelas,
            'id_jurusan' => $request->id_jurusan,
            'id_pembimbing' => $request->id_pembimbing,
            'id_dudi' => $request->id_dudi,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
