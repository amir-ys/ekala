<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'files' => $this->faker->imageUrl,
            'type' => New Sequence('image' , 'zip' , 'video')  ,
            'user_id' => User::factory(),
            'mediable_id' => Product::factory(),
            'mediable_type' => Product::class,
            'client_file_name' => $this->faker->word  . '.' . 'png' ,
            'is_primary' => new sequence(1, 0),
            'is_private' => new sequence(1, 0),
        ];
    }
}
