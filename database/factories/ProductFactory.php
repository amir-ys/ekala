<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'brand_id' => Brand::factory(),
            'category_id' => Category::factory(),
            'price' => $this->faker->numerify('####'),
            'quantity' => $this->faker->numerify('#'),
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'status' => new Sequence(1, 0),
            'delivery_amount' => $this->faker->numerify('###'),
            'delivery_amount_per_product' => $this->faker->numerify,
        ];
    }
}
