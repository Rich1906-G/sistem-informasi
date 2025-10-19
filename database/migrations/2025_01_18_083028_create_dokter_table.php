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
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('account', 'id', 'dokter_account_id')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('nama_dokter');
            $table->string('email_dokter');
            $table->string('no_hp_dokter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
