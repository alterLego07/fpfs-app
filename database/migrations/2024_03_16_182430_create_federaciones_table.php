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
        Schema::create('federaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_federacion', 45)->nullable();
            $table->bigInteger('ciudad_id')->unsigned();
            $table->bigInteger('departamento_id')->unsigned();
            $table->date('fecha_afiliacion')->nullable();
            $table->longText('observaciones')->nullable();
            $table->string('image_url', 100)->nullable()->comment('Logo de la Federacion');
            $table->foreign('ciudad_id')
                ->references('id')
                ->on('ciudades')
                ->onDelete('cascade');
            $table->foreign('departamento_id')
                ->references('id')
                ->on('departamentos')
                ->onDelete('cascade');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('federaciones');
    }
};
