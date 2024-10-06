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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Hago referencia a la tabla users
            $table->date('appointment_date'); // Fecha para la cita
            $table->time('start_time'); // Hora inicio de cita
            $table->time('end_time'); // Hora fin de cita
            $table->string('status')->default('pending'); // Estado de la cita
            $table->timestamps();

            // Definición de las claves foráneas (si elimino un usuario de la base de datos, se elimina todas las citas asociadas a dicho usuario)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
