<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;


class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'n_cmp' => $this->faker->unique()->randomNumber(6),
        ];
    }
}
