<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JurusanController extends Controller
{
    //
    public function index()
    {
        $jurusans = Jurusan::all();

        return view('admin.jurusans.index', compact('jurusans'));
    }

    public function create()
    {
        return view('admin.jurusans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan' => 'required|string|max:255',
        ]);

        Jurusan::create([
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('admin.jurusan.index')->with('status', 'Data jurusan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::find($id);
        if ($jurusan) {
            $jurusan->delete();
            return redirect()->route('admin.jurusan.index')->with('success', 'Data jurusan berhasil dihapus.');
        }
        return redirect()->route('admin.jurusan.index')->with('error', 'Data jurusan tidak ditemukan.');
    }
}
