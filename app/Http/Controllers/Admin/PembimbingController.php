<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PembimbingController extends Controller
{
    //list user
    public function index()
    {
        $users = User::where('role', 'pembimbing')->get();

        return view('admin.pembimbings.index', compact('users'));
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

        return redirect()->route('admin.pembimbings.index')->with('status', 'Data Pembimbing berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.pembimbings.index')->with('success', 'Data Pembimbing berhasil dihapus.');
        }
        return redirect()->route('admin.pembimbings.index')->with('error', 'Data Pembimbing tidak ditemukan.');
    }
}
