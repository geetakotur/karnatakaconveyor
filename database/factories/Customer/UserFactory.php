<?php

namespace Database\Factories\Customer;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Customer\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail,
            'mobile' => '9' . $this->faker->randomNumber(9),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'registerd_on' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now'),

            // Auth
            'username' => $this->faker->userName,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
