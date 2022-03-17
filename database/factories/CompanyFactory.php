<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;

class CompanyFactory extends Factory
{
    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "company_name" => $this->faker->company,
            "supervisor" => $this->faker->name(),
            "address" => $this->faker->unique()->address(),
            "email" => $this->faker->unique()->safeEmail(),
            "website" => $this->faker->numberBetween(25, 50),
            "phone" => $this->faker->phoneNumber,
        ];
    }
}
