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
    {   //Creació taula tipus_comptes
        Schema::create('tipus_compte', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 20);
            $table->string('descripcio')->nullable();
            $table->string('imatge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipus_compte');
    }
};
