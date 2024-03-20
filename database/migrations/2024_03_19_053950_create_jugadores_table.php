<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('documento', 50);
            $table->foreignId('tipo_documento_id')->constrained('tipo_documentos');
            $table->string('apellido_jugador', 60)->nullable();
            $table->string('nombre_jugador', 60)->nullable();
            $table->string('nro_ficha_anterior', 50)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->foreignId('nacionalidad_id')->nullable()->constrained('nacionalidades');
            $table->foreignId('club_id')->nullable()->constrained('clubes');
            $table->string('fotografia', 200)->nullable();
            $table->string('foto_documento_frontal', 200)->nullable();
            $table->string('foto_documento_dorsal', 200)->nullable();
            $table->date('fecha_vencimiento_cedula')->nullable();
            $table->string('codigo_qr', 200)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->comment('Usuario Creador de la ficha');
            $table->integer('habilitado')->default(1)->comment('1 Habilitado\n2 Inhabilitado\n3 Libre');
            $table->tinyInteger('estado')->default(1)->comment('Activo/inactivo');
            $table->integer('sexo')->default(1)->comment('1 Masculino\n2 Femenino');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};
