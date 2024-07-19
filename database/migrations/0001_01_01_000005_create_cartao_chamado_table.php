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
        Schema::create('cartao_chamado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chamado_id');
            $table->unsignedBigInteger('cartao_id');
            $table->timestamps();

            $table->foreign('chamado_id')->references('id')->on('chamados')->onDelete('cascade');
            $table->foreign('cartao_id')->references('id')->on('cartaos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartaos_chamados');
    }
};
