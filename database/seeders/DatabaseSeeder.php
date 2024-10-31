<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('DELETE FROM users');
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@a.a',
            'password' => '12345678'
        ]);
        User::factory()->createMany(20);
    }
}
