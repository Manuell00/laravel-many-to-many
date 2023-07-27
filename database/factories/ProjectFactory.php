<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Genera un numero casuale tra 0 e 100
        $randomNumber = $this->faker->numberBetween(0, 100);

        return [
            'project_name' => implode('_', fake()->words(3)),
            'description' => fake()->paragraph(),
            'start_date' => fake()->dateTimeBetween('-4 year', 'now'),
            'end_date' => fake()->dateTimeBetween('now', '+10 year'),
            'status' => fake()->randomElement(['In progress', 'Final_stages', 'Pending']),
            'budget' => fake()->randomFloat(2, 1000, 100000),
            'progress' => fake()->numberBetween(0, 100),
            'image' => "https://picsum.photos/id/{$randomNumber}//5000/3333"
        ];
    }
}
