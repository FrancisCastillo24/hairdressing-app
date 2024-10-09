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
        Schema::table('appointments', function (Blueprint $table) {
            // Creo el campo service_id para hacer referencia al id del servicio
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade'); // Agrega esta línea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // En caso de error, revertimos en la base de datos
            $table->dropForeign(['service_id']); // Elimina la clave foránea
        });
    }
};
