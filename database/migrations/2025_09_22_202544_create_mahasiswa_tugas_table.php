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
        Schema::create('mahasiswa_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa', 'id', 'mahasiswa_tugas_mahasiswa_id');
            $table->foreignId('tugas_id')->constrained('tugas', 'id', 'mahasiswa_tugas_tugas_id');
            $table->enum('status', ['Disetujui', 'Tidak Disetujui'])->default('Tidak Disetujui');
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_tugas');
    }
};
