<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryBoysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_boys')->insert([
            ['name' => 'A', 'max_orders' => 2],
            ['name' => 'B', 'max_orders' => 4],
            ['name' => 'C', 'max_orders' => 5],
            ['name' => 'D', 'max_orders' => 3],
        ]);
    }
}
