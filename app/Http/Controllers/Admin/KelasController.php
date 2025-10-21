<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelasController extends Controller
{
    //
    public function index()
    {
        $kelas = Kelas::all();

        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
        ]);

        Kelas::create([
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('admin.kelas.index')->with('status', 'Data kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelas = Kelas::find($id);
        return view('admin.kelas.edit', compact('kelas'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
        ]);

        $kelas = Kelas::find($id);

        $kelas->update($request->all());

        return redirect()->route('admin.kelas.index')->with('status', 'Data kelas berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        if ($kelas) {
            $kelas->delete();
            return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil dihapus.');
        }
        return redirect()->route('admin.kelas.index')->with('error', 'Data kelas tidak ditemukan.');
    }
}
