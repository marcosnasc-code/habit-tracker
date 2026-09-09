<?php

namespace Database\Factories;

use App\Models\HabitLog;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Habit;
/**
 * @extends Factory<HabitLog>
 */
class HabitLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'habit_id' => Habit::query()->inRandomOrder()->first()->id,
            'completed_at' => $this->faker->dateTimeBetween('-5 days', 'now'),
        ];
    }
}
