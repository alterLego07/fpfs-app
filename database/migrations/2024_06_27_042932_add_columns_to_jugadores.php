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
        Schema::table('jugadores', function (Blueprint $table) {
            $table->unsignedBigInteger('club_origen_id')->nullable()->after('club_id');
            $table->boolean('prestamo')->default(false)->after('club_origen_id');
            $table->date('tiempo_prestamo')->nullable()->after('prestamo');
            $table->text('observaciones')->nullable()->after('tiempo_prestamo');
            $table->foreign('club_origen_id')->references('id')->on('clubes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jugadores', function (Blueprint $table) {
            $table->dropForeign(['club_origen_id']);
            $table->dropColumn('club_origen_id');
            $table->dropColumn('prestamo');
            $table->dropColumn('tiempo_prestamo');
            $table->dropColumn('observaciones');
        });
    }
};
