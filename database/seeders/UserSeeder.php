<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * How many extra users (besides Admin) to create.
     */
    private const USER_COUNT = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'hy65fr43',
        ]);

        User::factory()
            ->count(self::USER_COUNT)
            ->withHabits(4)
            ->create();
    }
}
