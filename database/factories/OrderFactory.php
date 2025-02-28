<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement([
                'new',
                'in production',
                'shipped',
                'cancelled',
                'rejected',
                'draft'
            ]),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'items' => $this->faker->randomDigit(),
        ];
    }
}
