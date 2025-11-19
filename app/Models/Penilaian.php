<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    //
    protected $table = "penilaians";

    protected $fillable = ([
        'siswa_id',
        'dudi_id',
        'softskill_data',
        'hardskill_data',
        'rata_rata',
    ]);

    protected $casts = [
        'softskill_data' => 'array',
        'hardskill_data' => 'array',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
