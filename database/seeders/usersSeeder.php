<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        User::factory()->count(10)->create();

        /*
        User::factory()->create([
            'dasid' => 'A608553',
            'email' => 'brix.hernandez@atos.net',
            'first_name' => 'Test User',
            'last_name' => 'Brix',
            'instructor' => true,
            'role' => 'admin',
            'country' => 'Philippines'
        ]);
        */
    }
}
