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
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->string('iban', 34)->unique();
            $table->string('alias', 20);
            $table->decimal('saldo', 8, 2)->default(0);
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('tipus_compte_id')->constrained('tipus_compte')->onDelete('cascade');
            $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
