<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookSchedules>
 */
class BookSchedulesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' =>User::all()->random()->id,
            'details' =>$this->faker->paragraph(),
            'schedule_id' => Schedule::all()->random()->id,
            'status' => $this->faker->randomElement(['pending','approved']),
        ];
    }
}
