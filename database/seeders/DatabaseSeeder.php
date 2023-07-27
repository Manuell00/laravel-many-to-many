<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Richiamo nel db il file seeder
        $this->call([
            TypeTableSeeder::class,
            ProjectTableSeeder::class,
            UserTableSeeder::class
        ]);
    }
}
