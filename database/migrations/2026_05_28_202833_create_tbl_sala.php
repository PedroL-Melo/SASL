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
        Schema::create('tbl_sala', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->integer('capacidade');
            $table->string('bloco', 30);
            $table->integer('piso');
            $table->string('status_sala', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sala');
    }
};
