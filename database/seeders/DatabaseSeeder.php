<?php

namespace Database\Seeders;

use App\Http\Middleware\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Crida als seeders de les maneres definides
        $this->call([
            TipusCompteSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
