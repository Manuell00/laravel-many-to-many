<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Technology>
 */
class TechnologyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Java', 'PHP', 'C++', 'C#', 'python', 'Javascript', 'Bash', 'HTML', 'CSS', 'SQL'
            ]),
            'description' => fake()->paragraph(),
        ];
    }
}
