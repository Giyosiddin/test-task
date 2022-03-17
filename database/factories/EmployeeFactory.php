<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "passport_serial" => $this->faker->bothify('########'),
            "first_name" => $this->faker->name(),
            "last_name" => $this->faker->lastName(),
            "father_name" => $this->faker->firstNameFemale,
            "position" => $this->faker->word,
            "phone" => $this->faker->unique()->phoneNumber,
            "address" => $this->faker->unique()->address,
            "company_id" => $this->faker->unique(true)->numberBetween(1, 5),
        ];
    }
}
