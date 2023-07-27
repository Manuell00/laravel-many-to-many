<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Uso il model
use App\Models\Project;
use App\Models\Type;


class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects =  Project::factory()->count(30)->make();

        // Ciclo sui record dei progetti, classico per i ONE-TO-MANY
        foreach ($projects as $project) {

            // Creo una variabile type per recuperare una tipologia randomica tra quelle già presenti nel db
            $type = Type::inRandomOrder()->first();

            // Prendo il relativo id e lo salvo nella chiave esterna
            $project->type_id = $type->id;

            // Salvo
            $project->save();
        }
    }
}
