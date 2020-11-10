<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Product_type;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'product_type_id' => Product_type::all()->random()->id,
            'reference' => $this->faker->ean13,
            'stock' => $this->faker->unique()->numberBetween($min = 0, $max = 200),
            'min_value' => $this->faker->unique()->numberBetween($min = 0, $max = 100),
            'max_value' => $this->faker->unique()->numberBetween($min = 100, $max = 200),
            'unit_id' => Unit::all()->random()->id,
            'picture_url' => 'https://dejagerart.com/wp-content/uploads/2018/09/Test-Logo-Circle-black-transparent.png',
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'company_id' => Company::all()->random()->id,
        ];
    }
}
