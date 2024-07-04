<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $parentCategory = Category::inRandomOrder()->first();
        $parentId = $parentCategory ? $parentCategory->id : null;
        return [
            //
            'name'=> fake()->name(),
            'description'=> $this->faker->text,
            'parent_id'=> $parentId

        ];
    }
}
