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
            $table->foreignId('tugas_id')->constrained('tugas', 'id', 'project_tugas_id')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_project');
            $table->string('nama_file_project')->nullable();
            $table->string('file_project')->nullable();
            $table->enum('status', ['Belum Submit', 'Sudah Submit'])->defatul('Belum Submit');
            $table->timestampTz('testing');
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
