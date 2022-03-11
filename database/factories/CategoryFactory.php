<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class CategoryFactory extends Factory
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
            'parent_id' => null ,
            'slug' => $this->faker->slug(),
            'status' => new Sequence(1, 0),
            'description' => $this->faker->text,
            'icon' => $this->faker->word(),
        ];
    }
}
