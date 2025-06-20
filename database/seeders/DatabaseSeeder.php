<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Removed direct user creation as it is handled by UserSeeder

        $this->call([ 
            UserSeeder::class,
            ExpertSeeder::class,
            GeographicalDataSeeder::class,
        ]);
    }
}
