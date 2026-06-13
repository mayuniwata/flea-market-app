<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition()
{
    return [
        'user_id' => \App\Models\User::factory(),
        'name' => $this->faker->word(),
        'price' => $this->faker->numberBetween(1000, 10000),
        'brand' => $this->faker->company(),
        'description' => $this->faker->sentence(),
        'image' => 'sample.jpg',
        'condition' => '良好',
    ];
}
}