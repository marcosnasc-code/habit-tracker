<?php

namespace Database\Seeders;

use App\Models\Habit;
use App\Models\User;
use Database\Factories\HabitFactory;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    /**
     * Ensure Admin (and any user without habits) gets the default set.
     */
    public function run(): void
    {
        User::query()
            ->whereDoesntHave('habits')
            ->each(function (User $user): void {
                foreach (HabitFactory::DEFAULT_HABITS as $name) {
                    Habit::query()->create([
                        'user_id' => $user->id,
                        'name' => $name,
                    ]);
                }
            });
    }
}
