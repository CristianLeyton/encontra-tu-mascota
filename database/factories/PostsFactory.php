<?php

namespace Database\Factories;

use App\Models\Species;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sizes = ['muy pequeño', 'pequeño', 'mediano', 'grande', 'muy grande'];

        return [
            //
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->address(),
            'species_id' => Species::all()->random()->id,
            'breed_id' => null,
            'color' => $this->faker->colorName(),
            'size' => Arr::random($sizes),
            'is_published' => true,
            'is_resolved' => false,
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'name_contact' => $this->faker->name(),
            'email_contact' => $this->faker->unique()->safeEmail(),
            'phone_contact' => $this->faker->phoneNumber(),
            'user_id' => 1,
        ];
    }
}
