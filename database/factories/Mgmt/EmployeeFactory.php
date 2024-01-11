<?php

namespace Database\Factories\Mgmt;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Mgmt\Employee;
use Carbon\Carbon;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'email_verified_at' => now(),

            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,

            'salary' => $this->faker->numberBetween($min = 50000, $max = 900000),
            'eid' => Str::uuid()->toString(),

            'joining_date' => Carbon::now(),
        ];
    }
}
