<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users')->constrained('users')->cascadeOnDelete();
            $table->string('nisn')->unique();
            $table->foreignId('id_kelas')->constrained('kelas');
            $table->foreignId('id_jurusan')->constrained('jurusans');
            $table->enum('kelamin',['laki-laki','perempuan']);
            $table->string('tempat')->nullable();
            $table->string('tanggal_lahir');
            $table->string('gol_dar');
            $table->text('alamat');
            $table->string('no_telpon');
            $table->foreignId('id_pembimbing')->constrained('users');
            $table->foreignId('id_dudi')->constrained('dudis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
