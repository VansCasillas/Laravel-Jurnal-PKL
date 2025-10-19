<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    //
    protected $table = "absensis";

    protected $fillable = ([
        'id_siswa',
        'tanggal_absen',
        'jam_mulai',
        'jam_selesai',
        'status',
        'keterangan',
    ]);

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'id_users');
    } 
}
