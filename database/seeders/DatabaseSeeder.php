<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Carbon\Carbon;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Todo::create([
            'title' => "Test 1",
            'status' => "pending",
            'due_date' => Carbon::now(),
        ]);
    }
}
