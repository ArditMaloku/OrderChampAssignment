<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
     *
     * @return array
     */
    public function definition()
    {
        $randomPrice = rand(10, 30);

        return [
            'name'          => $this->faker->name(),
            'description'   => $this->faker->paragraph(),
            'sale_price'    => $randomPrice,
            'regular_price' => $randomPrice,
            'stock'         => rand(1, 10),
        ];
    }
}
