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
        Schema::create('mahasiswa_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa', 'id', 'mahasiswa_project_mahasiswa_id')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('project_id')->constrained('project', 'id', 'mahasiswa_project_project_id')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('file_project')->nullable();
            $table->enum('status', ['Disetujui', 'Tidak Disetujui'])->default('Tidak Disetujui');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_project');
    }
};
