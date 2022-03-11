<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title ,
            'body' => $this->faker->text ,
            'priority' => $this->faker->numerify('##') ,
            'status' => new Sequence(1,0) ,
            'type' => $this->faker->word ,
            'btn_link' => $this->faker->url ,
            'btn_text' => $this->faker->word ,
            'btn_icon' => $this->faker->word ,
        ];
    }
}
