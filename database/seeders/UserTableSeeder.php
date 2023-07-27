<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Project;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =  User::factory()->count(10)->make();

        // Ciclo sui record degli user, classico per i ONE-TO-MANY
        foreach ($users as $user) {

            // Creo una variabile project per recuperare una tipologia randomica tra quelle già presenti nel db
            $project = Project::inRandomOrder()->first();

            // Prendo il relativo id e lo salvo nella chiave esterna
            $user->project_id = $project->id;

            // Salvo
            $user->save();
        }
    }
}
