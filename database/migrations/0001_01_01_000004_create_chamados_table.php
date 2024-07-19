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
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('ID do usuário que fez o chamado');
            $table->decimal('latitude', 10, 7)->comment('Latitude obtida automaticamente')->nullable();
            $table->decimal('longitude', 10, 7)->comment('Longitude obtida automaticamente')->nullable();
            $table->string('geolocalizacao')->comment('Geolocalização obtida automaticamente')->nullable();
            $table->string('anotacao_samu')->comment('Anotação do SAMU sobre o chamado')->nullable();
            $table->integer('situacao')->comment('4-cancelado, 1-aberto, 2-em andamento, 3-encerrado')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};
