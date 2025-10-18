<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    //
    protected $table = ([
        'id_siswa',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kegiatan',
        'dokumentasi',
        'catatan_pembimbing',
    ]);

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'id_users');
    } 
}
