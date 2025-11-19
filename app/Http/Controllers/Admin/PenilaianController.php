<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Softskill;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $penilaian = Softskill::all();
        return view("admin.penilaian.index", compact('penilaian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.penilaian.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'kriteria' => 'required|string',
            'aspek_penilaian' => 'required|string'
        ]);

        Softskill::create([
            'kriteria' => $request->kriteria,
            'aspek_penilaian' => $request->aspek_penilaian,
        ]);

        return redirect()->route('admin.penilaian.index')->with('success', 'Berhasil menambahkan poin penilaian');
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
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
        $softskill = Softskill::find($id);
        
        $softskill->delete();

        return view('admin.penilaian.index')->with('success','berhasil menghapus data');
    }
}
