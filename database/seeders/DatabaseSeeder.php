<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        User::factory()->create([
            'name' => 'Brex',
            'email' => 'test@gmail.com',
            'is_admin' => true
        ]);

        User::factory()->create([
            'name' => 'Brex2',
            'email' => 'test2@gmail.com',
        ]);
        User::factory()->create([
            'name' => 'Brex3',
            'email' => 'test3@gmail.com',
        ]);

        \App\Models\Listing::factory(10)->create([
            'by_user_id' => 1
        ]);

        \App\Models\Listing::factory(10)->create([
            'by_user_id' => 2
        ]);
    }
}
