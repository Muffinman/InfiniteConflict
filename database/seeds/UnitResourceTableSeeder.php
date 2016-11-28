<?php

use Illuminate\Database\Seeder;

class UnitResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unit_resource')->insert([
            ['unit_id' => 1, 'resource_id' => 1, 'cost' => 1500, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 1, 'resource_id' => 2, 'cost' => 350, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 1, 'resource_id' => 7, 'cost' => 500, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 1],
            ['unit_id' => 2, 'resource_id' => 1, 'cost' => 1500, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 2, 'resource_id' => 2, 'cost' => 3000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 2, 'resource_id' => 7, 'cost' => 1500, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 1],
            ['unit_id' => 3, 'resource_id' => 1, 'cost' => 17000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 3, 'resource_id' => 2, 'cost' => 3800, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 3, 'resource_id' => 7, 'cost' => 5000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 1],
            ['unit_id' => 4, 'resource_id' => 1, 'cost' => 25000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 4, 'resource_id' => 2, 'cost' => 50000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 4, 'resource_id' => 7, 'cost' => 25000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 1],
            ['unit_id' => 5, 'resource_id' => 1, 'cost' => 160000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 5, 'resource_id' => 2, 'cost' => 37000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 5, 'resource_id' => 7, 'cost' => 50000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 1],
            ['unit_id' => 6, 'resource_id' => 1, 'cost' => 300000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 6, 'resource_id' => 2, 'cost' => 600000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 6, 'resource_id' => 7, 'cost' => 300000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 1],
            ['unit_id' => 7, 'resource_id' => 1, 'cost' => 24000, 'output' => 0, 'stores' => 120000, 'refund_on_completion' => 0],
            ['unit_id' => 7, 'resource_id' => 2, 'cost' => 16000, 'output' => 0, 'stores' => 80000, 'refund_on_completion' => 0],
            ['unit_id' => 7, 'resource_id' => 3, 'cost' => 0, 'output' => 0, 'stores' => 40000, 'refund_on_completion' => 0],
            ['unit_id' => 7, 'resource_id' => 4, 'cost' => 0, 'output' => 0, 'stores' => 40000, 'refund_on_completion' => 0],
            ['unit_id' => 7, 'resource_id' => 7, 'cost' => 20000, 'output' => 0, 'stores' => 40000, 'refund_on_completion' => 1],
            ['unit_id' => 7, 'resource_id' => 8, 'cost' => 0, 'output' => 0, 'stores' => 40000, 'refund_on_completion' => 0],
            ['unit_id' => 7, 'resource_id' => 9, 'cost' => 0, 'output' => 0, 'stores' => 40000, 'refund_on_completion' => 0],
            ['unit_id' => 8, 'resource_id' => 1, 'cost' => 48000, 'output' => 0, 'stores' => 240000, 'refund_on_completion' => 0],
            ['unit_id' => 8, 'resource_id' => 2, 'cost' => 36000, 'output' => 0, 'stores' => 160000, 'refund_on_completion' => 0],
            ['unit_id' => 8, 'resource_id' => 3, 'cost' => 0, 'output' => 0, 'stores' => 80000, 'refund_on_completion' => 0],
            ['unit_id' => 8, 'resource_id' => 4, 'cost' => 0, 'output' => 0, 'stores' => 80000, 'refund_on_completion' => 0],
            ['unit_id' => 8, 'resource_id' => 7, 'cost' => 50000, 'output' => 0, 'stores' => 80000, 'refund_on_completion' => 1],
            ['unit_id' => 8, 'resource_id' => 8, 'cost' => 0, 'output' => 0, 'stores' => 80000, 'refund_on_completion' => 0],
            ['unit_id' => 8, 'resource_id' => 9, 'cost' => 0, 'output' => 0, 'stores' => 80000, 'refund_on_completion' => 0],
            ['unit_id' => 9, 'resource_id' => 1, 'cost' => 96000, 'output' => 0, 'stores' => 480000, 'refund_on_completion' => 0],
            ['unit_id' => 9, 'resource_id' => 2, 'cost' => 64000, 'output' => 0, 'stores' => 320000, 'refund_on_completion' => 0],
            ['unit_id' => 9, 'resource_id' => 3, 'cost' => 0, 'output' => 0, 'stores' => 160000, 'refund_on_completion' => 0],
            ['unit_id' => 9, 'resource_id' => 4, 'cost' => 0, 'output' => 0, 'stores' => 160000, 'refund_on_completion' => 0],
            ['unit_id' => 9, 'resource_id' => 7, 'cost' => 100000, 'output' => 0, 'stores' => 160000, 'refund_on_completion' => 1],
            ['unit_id' => 9, 'resource_id' => 8, 'cost' => 0, 'output' => 0, 'stores' => 160000, 'refund_on_completion' => 0],
            ['unit_id' => 9, 'resource_id' => 9, 'cost' => 0, 'output' => 0, 'stores' => 160000, 'refund_on_completion' => 0],
            ['unit_id' => 10, 'resource_id' => 1, 'cost' => 192000, 'output' => 0, 'stores' => 960000, 'refund_on_completion' => 0],
            ['unit_id' => 10, 'resource_id' => 2, 'cost' => 128000, 'output' => 0, 'stores' => 640000, 'refund_on_completion' => 0],
            ['unit_id' => 10, 'resource_id' => 3, 'cost' => 0, 'output' => 0, 'stores' => 320000, 'refund_on_completion' => 0],
            ['unit_id' => 10, 'resource_id' => 4, 'cost' => 0, 'output' => 0, 'stores' => 320000, 'refund_on_completion' => 0],
            ['unit_id' => 10, 'resource_id' => 7, 'cost' => 200000, 'output' => 0, 'stores' => 320000, 'refund_on_completion' => 1],
            ['unit_id' => 10, 'resource_id' => 8, 'cost' => 0, 'output' => 0, 'stores' => 320000, 'refund_on_completion' => 0],
            ['unit_id' => 10, 'resource_id' => 9, 'cost' => 0, 'output' => 0, 'stores' => 320000, 'refund_on_completion' => 0],
            ['unit_id' => 11, 'resource_id' => 1, 'cost' => 30000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 11, 'resource_id' => 2, 'cost' => 20000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 11, 'resource_id' => 7, 'cost' => 50000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 1],
            ['unit_id' => 11, 'resource_id' => 8, 'cost' => 0, 'output' => 0, 'stores' => 50000, 'refund_on_completion' => 0],
            ['unit_id' => 12, 'resource_id' => 1, 'cost' => 30000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 12, 'resource_id' => 2, 'cost' => 20000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 0],
            ['unit_id' => 12, 'resource_id' => 7, 'cost' => 50000, 'output' => 0, 'stores' => 0, 'refund_on_completion' => 1],
        ]);
    }
}
