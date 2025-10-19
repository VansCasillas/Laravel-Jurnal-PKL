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
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->string('nisn')->unique();
            $table->foreignId('id_kelas')->nullable()->constrained('kelas');
            $table->foreignId('id_jurusan')->nullable()->constrained('jurusans');
            $table->enum('kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->string('tempat')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('gol_dar')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telpon')->nullable();
            $table->foreignId('id_pembimbing')->nullable()->constrained('users');
            $table->foreignId('id_dudi')->nullable()->constrained('dudis');
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
