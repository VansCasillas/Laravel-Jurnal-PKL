<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    //list user
    public function index()
    {
        $users = User::where('role', 'siswa')->get();

        return view('admin.siswas.index',compact('users'));
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
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        return redirect()->route('admin.siswas.index')->with('status', 'Data Siswa berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.siswas.index')->with('success', 'Data siswa berhasil dihapus.');
        }
        return redirect()->route('admin.siswas.index')->with('error', 'Data siswa tidak ditemukan.');
    }
}
