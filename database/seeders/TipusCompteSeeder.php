<?php

namespace Database\Seeders;

use App\Models\TipusCompte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipusCompteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    //Insertem les dades a la nostre base de dades a tipus de compte
    public function run(): void
    {
        TipusCompte::create([
            'nom' => 'Corrent',
            'descripcio' => 'Compte per a operacions del dia a dia',
            'imatge' => 'imatges/CuentaTipoCorriente.png'
        ]);

        TipusCompte::create([
            'nom' => 'Estalvi',
            'descripcio' => 'Compte per a estalviar diners',
            'imatge' => 'imatges/CuentaTipoAhorros.png'
        ]);

        TipusCompte::create([
            'nom' => 'Inversions',
            'descripcio' => 'Compte per a inversions financeres',
            'imatge' => 'imatges/CuentaTipoInversiones.png'
        ]);
    }
}
