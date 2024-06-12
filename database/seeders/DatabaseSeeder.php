<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Survey;
use App\Models\Question;
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
            'name' => 'asd',
            'email' => 'asd@asd.com',
            'password' => bcrypt('asdasdasd'),
            'email_verified_at' => time()
        ]);

        Survey::factory()
        ->count(3)
        ->hasQuestions(4)
        ->create();

        
    }
}
