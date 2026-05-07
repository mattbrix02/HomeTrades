<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'description' => fake()->sentences(3, true),
            'short_description' => fake()->sentences(1, true),
            'instructor' => '11',
            'publish_date' => fake()->dateTime(),
            'expiration_date' => fake()->dateTime(),

        ];
    }
}
