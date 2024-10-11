<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\TrackingDetail;

class TrackingDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TrackingDetail::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(["pending","shipped","delivered"]),
            'order_id' => Order::factory(),
            'tracking_number' => $this->faker->word(),
            'courier_name' => $this->faker->word(),
        ];
    }
}
