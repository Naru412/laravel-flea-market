<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word(),
            'brand' => $this->faker->company(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(1000,10000),
            'condition' => $this->faker->randomElement([
                '新品',
                '良好',
                '普通',
                '傷あり'
            ]),
            'image' => 'test.jpg',
        ];
    }
}
