<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code'           => (string) Str::orderedUuid(),
            'amount'         => 5,
            'minimum_amount' => rand(5, 100),
        ];
    }
}
