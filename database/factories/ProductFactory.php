<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'seller_id' => function () {
                return \App\Models\Seller::factory()->create()->id;
            },
            'category_id' => function () {
                return \App\Models\Category::factory()->create()->id;
            },
            'title' => $this->faker->words(3, true),
            'subtitle' => $this->faker->sentence,
            'description' =>  $this->faker->text(200),
            'quantity' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'offer' => $this->faker->randomFloat(2, 5, 30),
        ];
    }
}
