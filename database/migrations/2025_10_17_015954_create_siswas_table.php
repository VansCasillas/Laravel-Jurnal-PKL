<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->string('nis')->unique()->nullable();
            $table->foreignId('id_kelas')->nullable()->constrained('kelas')->nullOnDelete();
            $table->foreignId('id_jurusan')->nullable()->constrained('jurusans')->nullOnDelete();
            $table->enum('kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('tempat')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('gol_dar')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telpon')->nullable();
            $table->foreignId('id_pembimbing')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('id_dudi')->nullable()->constrained('dudis')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};

