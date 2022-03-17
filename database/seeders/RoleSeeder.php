<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'name' => 'admin',
            ],
            [
                'id' => '2',
                'name' => 'company',
            ]
            ];
            DB::table("roles")->insert($data);
    }
}
