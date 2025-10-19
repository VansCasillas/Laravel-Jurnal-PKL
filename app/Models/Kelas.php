<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    //
    protected $table = "kelas";

    public function siswa() {
        return $this->hasMany(Siswa::class, 'id_users');
    } 
}
