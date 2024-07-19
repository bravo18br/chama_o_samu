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
        Schema::create('ips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chamado_id');
            $table->string('user_ip');
            $table->string('pais');
            $table->string('regiao');
            $table->string('cidade');
            $table->string('zip');
            $table->string('isp');
            $table->timestamps();

            $table->foreign('chamado_id')->references('id')->on('chamados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ips');
    }
};
