<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->hasTasks(5, [
                'is_completed' => false,
            ])
            ->hasTasks(5, [
                'is_completed' => true,
            ])
            ->create(['login' => 'test']);
    }
}
