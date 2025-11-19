<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use App\Models\User;
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
        $pembimbings = User::where('role', 'pembimbingDudi')->get();
        return view('admin.dudis.create', compact('pembimbings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dudi' => 'required|string|unique:dudis,nama_dudi',
            'jenis_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'pimpinan' => 'required|string|max:255',
            'pembimbing' => 'required|exists:users,id',
            'kontak' => 'required|string|max:255',
        ]);

        Dudi::create([
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
        $pembimbings = User::where('role', 'pembimbingDudi')->get();
        return view('admin.dudis.edit', compact('dudi', 'pembimbings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dudi $dudi)
    {
        //
        $request->validate([
            'nama_dudi' => 'required|string|unique:dudis,nama_dudi,' . $dudi->id,
            'jenis_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'pimpinan' => 'required|string|max:255',
            'pembimbing' => 'required|exists:users,id',
            'kontak' => 'required|string|max:255',
        ]);

        $data = [
            'nama_dudi'=> $request->nama_dudi,
            'jenis_usaha'=> $request->jenis_usaha,
            'alamat'=> $request->alamat,
            'pimpinan'=> $request->pimpinan,
            'pembimbing'=> $request->pembimbing,
            'kontak'=> $request->kontak,
        ];

        $dudi->update($data);

        return redirect()->route('admin.dudi.index')->with('status', 'Data Dudi berhasil diperbarui.');
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
