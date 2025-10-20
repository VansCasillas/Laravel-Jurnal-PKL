<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use Illuminate\Http\Request;

class DudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dudis = Dudi::all();
        return view('admin.dudis.index', compact('dudis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dudis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dudi' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'pimpinan' => 'required|string|max:255',
            'pembimbing' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
        ]);

        // Simpan ke tabel users dulu
        $user = Dudi::create([
            'nama_dudi' => $request->nama_dudi,
            'jenis_usaha' => $request->jenis_usaha,
            'alamat' => $request->alamat,
            'pimpinan' => $request->pimpinan,
            'pembimbing' => $request->pembimbing,
            'kontak' => $request->kontak,
        ]);

        return redirect()->route('admin.dudi.index')->with('status', 'Data Dudi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dudi $dudi)
    {
        return view('admin.dudis.edit', compact('dudi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dudi = Dudi::find($id);
        if ($dudi) {
            $dudi->delete();
            return redirect()->route('admin.dudi.index')->with('success', 'Data Dudi berhasil dihapus.');
        }
        return redirect()->route('admin.dudi.index')->with('error', 'Data Dudi tidak ditemukan.');
    }
}
