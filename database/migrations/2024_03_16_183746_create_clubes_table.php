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
        Schema::create('clubes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_club', 50)->nullable();
            $table->date('fecha_afiliacion')->nullable();
            $table->bigInteger('ciudad_id')->unsigned();
            $table->bigInteger('departamento_id')->unsigned();
            $table->bigInteger('federacion_id')->unsigned();
            $table->text('observacion');
            $table->string('image_url', 100)->nullable();

            $table->foreign('ciudad_id')
                ->references('id')
                ->on('ciudades')
                ->onDelete('cascade');

            $table->foreign('departamento_id')
                ->references('id')
                ->on('departamentos')
                ->onDelete('cascade');

            $table->foreign('federacion_id')
                ->references('id')
                ->on('federaciones')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubes');
    }
};
