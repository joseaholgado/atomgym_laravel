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
        Schema::create('entrenamientos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->foreign('user_id')->references('id')->on('users');
            $table->id();
            $table->unsignedBigInteger('musculo_id');
            $table->string('nombre_ejercicio');
            $table->integer('series');
            $table->integer('repeticiones');
            $table->text('descripcion');
            $table->string('imagen_ruta')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrenamientos');
    }
};
