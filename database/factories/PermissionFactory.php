<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fa_name' => $this->faker->text(5) ,
            'name' => $this->faker->unique->text(5) ,
            'guard_name' => new Sequence('web' , 'api')
        ];
    }
}
