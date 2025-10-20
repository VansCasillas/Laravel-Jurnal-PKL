<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    //list user
    public function index()
    {
        $users = User::where('role', 'siswa')->get();

        return view('admin.siswas.index', compact('users'));
    }

    //Form tambah user
    public function create()
    {
        return view('admin.siswas.create');
    }

    //Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
            'nisn' => 'required|string|max:20',
        ]);

        // Simpan ke tabel users dulu
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        // Simpan ke tabel siswas
        Siswa::create([
            'id_user' => $user->id,
            'nisn' => $request->nisn,
        ]);

        return redirect()->route('admin.siswa.index')->with('status', 'Data Siswa berhasil ditambahkan.');
    }

    public function edit(User $siswa)
    {
        // tampil form edit user
        return view('admin.siswas.edit', compact('siswa'));
    }

    public function update(Request $request, User $user)
    {
        // Update data user
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Jika password diisi, update juga
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
        }
        return redirect()->route('admin.siswa.index')->with('error', 'Data siswa tidak ditemukan.');
    }
}
