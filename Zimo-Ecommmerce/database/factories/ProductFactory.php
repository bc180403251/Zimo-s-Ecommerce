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
            //
            'name'=> fake()->name(),
            'description'=> $this->faker->text,
            'imagUrl'=> $this->faker->imageUrl(640, 480, 'products', true, 'Faker'),
            'price'=> random_int(1 ,100)
        ];
    }
}
