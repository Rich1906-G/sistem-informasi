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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')
                ->constrained('account', 'id', indexName: 'mahasiswa_account_id')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_mahasiswa');
            $table->string('slug');
            $table->string('nim');
            $table->string('semester');
            $table->string('email');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('pas_foto');
            $table->string('nama_pas_foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
