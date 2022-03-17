<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table("companies")->insert([
            "company_name" => $faker->company,
            "supervisor" => $faker->name($gender = null|'male'|'female') ,
            "address" => $faker->address,
            "email" => $faker->safeEmail,
            "website" => $faker->numberBetween(25, 50),
            "phone" => $faker->phoneNumber,
        ]);
    }
}
