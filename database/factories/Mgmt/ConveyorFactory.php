<?php

namespace Database\Factories\Mgmt;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Mgmt\Conveyor;

class ConveyorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Conveyor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'modelno' => $this->faker->numerify('Model-###'),
            'image' => 'image-' . $this->faker->randomElement(['1', '2', '3', '4', '5', '6', '7']) . '.jpg',
            'desc' => $this->faker->text($maxNbChars = 200),

            'application' => 'Application',
            'width' => $this->faker->randomNumber(3),
            'weight' => $this->faker->randomNumber(3),
            'load' => $this->faker->randomNumber(3),
            'speed' => $this->faker->randomNumber(3),
            'movement' => 'linear',
        ];
    }
}
