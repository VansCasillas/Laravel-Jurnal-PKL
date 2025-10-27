<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $siswa = $user->siswa;

        // ambil bulan dari request (format: 1 - 12)
        $bulan = $request->get('bulan');

        // ambil semua kegiatan siswa
        $query = $siswa->kegiatan();

        // kalau user pilih bulan, filter berdasarkan bulan
        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        // ambil hasilnya
        $kegiatan = $query->orderBy('tanggal', 'desc')->get();

        return view('siswa.kegiatans.index', compact('user', 'siswa', 'kegiatan', 'bulan'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("siswa.kegiatans.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'dokumentasi' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
            'kegiatan' => 'required|string',
        ]);

        $data = [
            'id_siswa' => $siswa->id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kegiatan' => $request->kegiatan,
        ];

        if ($request->hasFile('dokumentasi')) {
            $imagePath = $request->file('dokumentasi')->store('dokumentasi', 'public');
            $data['dokumentasi'] = $imagePath;
        }

        Kegiatan::create($data);

        return redirect()->route('siswa.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
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
    }
}
