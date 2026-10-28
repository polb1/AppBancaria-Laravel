<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Crem l'usuari admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.cat',
            'password' => Hash::make('admin1234'), //Per encriptar la contrasenya utilitzem el hash. Aixi l'encripta abans de pujarla a la BD
        ]);
    }
}
