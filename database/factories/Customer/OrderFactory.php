<?php

namespace Database\Factories\Customer;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Customer\Order;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = $this->faker->randomElement($array = array (Order::STATUS_CLOSED, Order::STATUS_DUE, Order::STATUS_PENDING));
        $isQuote = $status == Order::STATUS_PENDING;
        
        return [
            'approved' => true,
            'message' => $this->faker->realText(),
            'status' => $status,
            'isQuote' => $isQuote,
            'total' => $this->faker->numberBetween($min = 50000, $max = 900000),
            'order_date' => Carbon::now(),
            'payment' => $this->faker->randomElement(['googlepay', 'phonepe', 'paytm', 'netbanking', 'cheque', 'dd']),
        ];
    }
}
