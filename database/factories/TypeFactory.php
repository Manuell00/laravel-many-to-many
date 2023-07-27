<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type>
 */
class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type_name' => fake()->unique()->randomElement([
                'fronte_end',
                'back_end',
                'Analysis',
                'Laravel',
                'JS',
                'AI',
                'Python',
                'React',
                'Vite',
                'Vue'

            ]),
            'description' => fake()->paragraph()
        ];
    }
}
