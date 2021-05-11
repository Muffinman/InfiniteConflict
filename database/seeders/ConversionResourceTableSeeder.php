<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ConversionResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conversion_resource')->insert([
            ['resource_id' => 8, 'cost_resource' => 1, 'cost' => 12, 'refund' => 0],
            ['resource_id' => 8, 'cost_resource' => 2, 'cost' => 8, 'refund' => 0],
            ['resource_id' => 8, 'cost_resource' => 3, 'cost' => 20, 'refund' => 0],
            ['resource_id' => 8, 'cost_resource' => 7, 'cost' => 10, 'refund' => 1],
            ['resource_id' => 9, 'cost_resource' => 1, 'cost' => 5, 'refund' => 0],
            ['resource_id' => 9, 'cost_resource' => 2, 'cost' => 20, 'refund' => 0],
            ['resource_id' => 9, 'cost_resource' => 3, 'cost' => 25, 'refund' => 0],
            ['resource_id' => 9, 'cost_resource' => 7, 'cost' => 20, 'refund' => 1],
        ]);
    }
}
