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
            // Agregar la columna service_id si no existe
            if (!Schema::hasColumn('appointments', 'service_id')) {
                $table->unsignedBigInteger('service_id')->after('end_time'); // Asegúrate de colocar el nuevo campo en la posición correcta
            }

            // Definir la clave foránea
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Elimina la clave foránea primero
            $table->dropForeign(['service_id']);
            // Luego elimina la columna service_id
            $table->dropColumn('service_id');
        });
    }
};
