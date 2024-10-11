<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(-10000, 10000),
            'stock' => $this->faker->numberBetween(-10000, 10000),
            'description' => $this->faker->text(),
            'thumbnail' => $this->faker->word(),
            'category_id' => Category::factory(),
        ];
    }
}
