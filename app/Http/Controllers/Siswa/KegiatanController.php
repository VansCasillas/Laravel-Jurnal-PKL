<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KegiatanController extends Controller
{

    public function kegiatanAdmin(Request $request)
    {
        $kegiatan = Kegiatan::with('siswa')->get();
        return view('admin.kegiatans.kegiatan', compact('kegiatan'));
    }

    public function kegiatanPembimbing(Request $request)
    {
        $user = auth()->user(); // ambil data user yang sedang login

        if ($user->role === 'pembimbing') {
            // Pembimbing hanya bisa lihat kegiatan siswa bimbingannya
            $kegiatan = Kegiatan::with('siswa')
                ->whereHas('siswa', function ($query) use ($user) {
                    $query->where('id_pembimbing', $user->id); // sesuaikan kolom relasi di tabel siswa
                })
                ->get();
        }
        return view('pembimbing.kegiatans.kegiatan', compact('kegiatan'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $siswaId = Auth::user()->siswa->id;
        $kegiatan = Kegiatan::where('id_siswa', $siswaId)->get();

        $selectedMonth = (int) $request->query('bulan');
        $selectedYear  = (int) $request->query('tahun');

        // Folder per bulan+tahun
        $folders = $kegiatan->groupBy(function ($item) {
            $tanggal = Carbon::parse($item->tanggal);
            return $tanggal->translatedFormat('F Y'); // contoh: November 2024
        });

        if ($selectedMonth && $selectedYear) {
            // Filter kegiatan berdasarkan bulan+tahun yang dipilih
            $kegiatanPerBulan = $kegiatan->filter(function ($item) use ($selectedMonth, $selectedYear) {
                $tanggal = Carbon::parse($item->tanggal);
                return $tanggal->month == $selectedMonth && $tanggal->year == $selectedYear;
            });

            $namaBulan = Carbon::create($selectedYear, $selectedMonth, 1)->translatedFormat('F Y');

            return view('siswa.kegiatans.index', [
                'folders' => $folders,
                'selectedMonth' => $selectedMonth,
                'selectedYear' => $selectedYear,
                'namaBulan' => $namaBulan,
                'kegiatanPerBulan' => $kegiatanPerBulan
            ]);
        }

        return view('siswa.kegiatans.index', [
            'folders' => $folders,
            'selectedMonth' => null,
            'kegiatanPerBulan' => null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
            'jam_selesai' => 'required|after:jam_mulai',
            'dokumentasi' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kegiatan' => 'required',
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
        $user = auth()->user();
        $siswa = $user->siswa;
        $kegiatan = Kegiatan::findOrFail($id);

        // Pastikan hanya pemilik kegiatan yang bisa lihat
        if ($kegiatan->id_siswa != Auth::user()->siswa->id) {
            abort(403);
        }

        return view('siswa.kegiatans.show', compact('kegiatan', 'siswa'));
    }

    public function detail(string $id)
    {
        $user = auth()->user();
        $siswa = $user->siswa;
        $kegiatan = Kegiatan::findOrFail($id);

        return view('pembimbing.kegiatans.detail', compact('kegiatan', 'siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        return view('siswa.kegiatans.edit', compact('kegiatan'));
    }

    public function komentar(Request $request, string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($request->filled('catatan_pembimbing')) {
            $request->catatan_pembimbing;
        }

        $data = $request->only(['catatan_pembimbing']);
        
        $kegiatan->update($data);

        return redirect()->route('pembimbing.kegiatan')->with('success', 'Catatan berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kegiatan' => 'required|string',
            'dokumentasi' => 'nullable|images|mimes:jpg,jpeg,png,webp|max:2048',
            'catatan_pembimbing' => 'nullable',
        ]);

        $data = $request->only(['tanggal', 'jam_mulai', 'jam_selesai', 'kegiatan']);

        // Ganti foto kalau ada file baru
        if ($request->hasFile('dokumentasi')) {
            if ($kegiatan->dokumentasi && Storage::disk('public')->exists($kegiatan->dokumentasi)) {
                Storage::disk('public')->delete($kegiatan->dokumentasi);
            }
            $data['dokumentasi'] = $request->file('dokumentasi')->store('dokumentasi', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('siswa.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->id_siswa != Auth::user()->siswa->id) {
            abort(403);
        }

        if ($kegiatan->dokumentasi && Storage::disk('public')->exists($kegiatan->dokumentasi)) {
            Storage::disk('public')->delete($kegiatan->dokumentasi);
        }

        $kegiatan->delete();

        return redirect()->route('siswa.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
