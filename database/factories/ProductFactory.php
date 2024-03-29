<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => ucfirst($this->faker->word()),
            'description' => ucfirst($this->faker->text()),
            'quantity' => $this->faker->randomNumber(),
            'price' => $this->faker->randomNumber(2),
            'category_id' => Category::get()->random()->id,

        ];
    }
}
