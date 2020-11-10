<?php

namespace Database\Factories;


use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'user_id' => User::all()->random()->id,
        ];
    }
}
