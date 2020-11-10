<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Company_type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'company_type_id' => Company_type::all()->random()->id,
            'address' => $this->faker->paragraphs(3, true),
            'mail' => $this->faker->companyEmail,
            'user_id' => User::all()->random()->id,
        ];
    }
}
