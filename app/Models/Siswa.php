<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    protected $table = ([
        'id_users',
        'id_kelas',
        'id_jurusan',
        'kelamin',
        'tempat',
        'tanggal_lahir',
        'gol_dar',
        'alamat',
        'no_telpon',
        'id_pembimbing',
        'id_dudi',
    ]);

    public function user() {
        return $this->belongsTo(Siswa::class, 'id_users');
    } 

    public function pembimbing() {
        return $this->belongsTo(Siswa::class, 'id_pembimbing');
    } 

    public function kelas() {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }

    public function jurusan() {
        return $this->belongsTo(jurusan::class, 'id_jurusan');
    } 

    public function dudi() {
        return $this->belongsTo(Dudi::class, 'id_dudi');
    } 

    public function kegiatan() {
        return $this->hasMany(Kegiatan::class, 'id_siswa');
    }

    public function absensi() {
        return $this->hasMany(Absensi::class, 'id_siswa');
    } 
}
