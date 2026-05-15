<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
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
            'title' => fake()->sentence(),
            'description' => fake()->sentences(3, true),
            'short_description' => fake()->sentences(1, true),
            'instructor' => function () {
                return User::where('instructor', true)->inRandomOrder()->first()?->id 
                    ?? User::factory()->state(['instructor' => true])->create()->id;
            },
            'publish_date' => fake()->dateTime(),
            'expiration_date' => collect(['2026-07-30 16:50:33', null])->random(),
            'project_id' => Project::inRandomOrder()->first()->id,
            'created_by' => User::inRandomOrder()->first()->id,
        ];
    }
}
