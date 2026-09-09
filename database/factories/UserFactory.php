<?php

namespace Database\Factories;

use App\Models\Habit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }

    /**
     * Attach a fixed set of habits to the user.
     */
    public function withHabits(int $count = 4): static
    {
        $habits = array_slice(HabitFactory::DEFAULT_HABITS, 0, $count);

        return $this->has(
            Habit::factory()
                ->count(count($habits))
                ->sequence(...array_map(
                    fn (string $name): array => ['name' => $name],
                    $habits,
                ))
        );
    }
}
