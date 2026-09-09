<?php

namespace Database\Factories;

use App\Models\Habit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Habit>
 */
class HabitFactory extends Factory
{
    /**
     * @var list<string>
     */
    public const DEFAULT_HABITS = [
        'Programar',
        'Estudar',
        'Jogar',
        'Ler',
        'Escutar música',
        'Assistir séries',
        'Fazer exercícios',
        'Meditar',
        'Fazer yoga',
        'Fazer pilates',
        'Fazer dança',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement(self::DEFAULT_HABITS),
        ];
    }
}
