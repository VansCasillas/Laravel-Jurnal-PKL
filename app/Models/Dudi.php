<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dudi extends Model
{
    //
    protected $table = "dudis";

    protected $fillable = ([
        'nama_dudi',
        'jenis_usaha',
        'alamat',
        'pimpinan',
        'pembimbing',
        'kontak',
    ]);

    public function siswa() {
        return $this->hasMany(Siswa::class, 'id_users');
    }

    public function user() {
        return $this->belongsTo(User::class, 'pembimbing');
    }
}
