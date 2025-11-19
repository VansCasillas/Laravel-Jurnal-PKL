<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Siswa;
use App\Models\Softskill;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $dudis = $user->pembimbingDudi;

        if ($dudis->isEmpty()) {
            return back()->with('error', 'Anda tidak membimbing dudi apapun');
        }

        $idDudi = $dudis->pluck('id')->toArray();

        $siswa = Siswa::with(['user', 'kelas', 'penilaians'])->whereIn('id_dudi', $idDudi)->get();

        return view('pembimbingDudi.penilaian.index', compact('siswa'));
    }

    public function form(Request $request) {
        $siswa_id = $request->siswa_id;

        $siswa = Siswa::with(['user', 'kelas', 'dudi'])->findOrFail($siswa_id);
        $penilaian = Penilaian::where('siswa_id', $siswa_id)->first();

        $softskills = Softskill::all();

        return view("pembimbingDudi.penilaian.form", compact('siswa', 'softskills', 'penilaian'));
    }

    public function save(Request $request) {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);

        $dudi_id = $siswa->dudi_id ?? $siswa->id_dudi ?? ($siswa->dudi->id ?? null);

        if(!$dudi_id) {
            return back()->withErrors('Siswa ini belum memiliki dudi');
        }

        $softskill_data = [];
        foreach ($request->all() as $key => $value) {
            if(str_starts_with($key, 'soft_')) {
                $id = str_replace('soft_', '', $key);
                $softskill_data[$id] = [
                    'nilai' => $value
                ];
            }
        }

        $hardskill_data = [];
        if($request->hardskill_aspek) {
            foreach($request->hardskill_aspek as $i => $aspek) {
                $hardskill_data[] = [
                    'aspek' => $aspek,
                    'nilai' => $request->hardskill_nilai[$i] ?? 0
                ];
            }
        }

        $all_nilai = array_merge(
            array_column($softskill_data, 'nilai'),
            array_column($hardskill_data, 'nilai')
        );

        $rata_rata = count($all_nilai) ? array_sum($all_nilai) / count($all_nilai) : 0;

        Penilaian::updateOrCreate(
            ['siswa_id' => $request->siswa_id],
            [
                'siswa_id' => $request->siswa_id,
                'dudi_id' => $dudi_id,
                'softskill_data' => $softskill_data,
                'hardskill_data' => $hardskill_data,
                'rata_rata' => $rata_rata,
            ]
        );

        return redirect()->route('pembimbingDudi.penilaian.index')->with('success', 'Penilaian berhasil disimpan');
    }
}
