<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Technology;
use App\Models\Project;

class TechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Creo 10 record di technology
        $technologies = Technology::factory()->count(10)->create();

        // Eseguo un foreach passando per ognuno di essi
        foreach ($technologies as $technology) {

            // Prendo dai 2 ai 4 record della tabella progetti
            $projects = Project::inRandomOrder()->limit(random_int(2, 4))->get();

            // Vado a compilare la tabella ponte
            $technology->projects()->attach($projects);
        }
    }
}
