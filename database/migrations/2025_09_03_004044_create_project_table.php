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
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_id')->constrained('tugas', 'id', 'project_tugas_id');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa', 'id', 'project_mahasiswa_id');
            $table->string('nama_project');
            $table->string('file_project');
            $table->enum('status', ['Selesai', 'Tidak Selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};
