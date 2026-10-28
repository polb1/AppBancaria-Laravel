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
        Schema::create('bizums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compte_origen_id')->constrained('comptes')->onDelete('cascade'); //Agafem el id per fer el compte que enviara els diners
            $table->foreignId('compte_desti_id')->constrained('comptes')->onDelete('cascade'); //I aqui el id del compte que rebra els diners
            $table->decimal('quantitat', 8, 2); //Posem decimal, per indicar els decimals que volem, que seran 2 i posar fins a un total de 8 
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bizum');
    }
};
