<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\;
use App\Models\Order;
use App\Models\Payment;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'payment_method' => $this->faker->randomElement(["card","bank_transfer","e-wallet"]),
            'payment_status' => $this->faker->randomElement(["pending","completed","failed"]),
            'order_id' => Order::factory(),
            'user_id' => ::factory(),
            'amount' => $this->faker->numberBetween(-10000, 10000),
            'transaction_id' => $this->faker->word(),
            'fraud_status' => $this->faker->randomElement(["pass","fail"]),
        ];
    }
}
