<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->sentences(3, true),
            'publish_date' => fake()->dateTime(),
            'expiration_date' => collect(['2026-07-30 16:50:33', null])->random(),
            'created_by' => User::firstOrCreate(['id' => 11], [
                'dasid' => 'A608553',
                'email' => 'brix.hernandez@atos.net',
                'first_name' => 'Test User',
                'last_name' => 'Brix',
                'instructor' => true,
                'role' => 'admin',
                'country' => 'Philippines',
                'password' => bcrypt('password'),
            ])->id,
        ];
    }
}
