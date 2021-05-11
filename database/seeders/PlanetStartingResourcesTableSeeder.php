<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PlanetStartingResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planet_starting_resources')->insert([
            ['resource_id' => 1, 'stored' => 30000, 'abundance' => 100],
            ['resource_id' => 2, 'stored' => 20000, 'abundance' => 100],
            ['resource_id' => 3, 'stored' => 1000, 'abundance' => 100],
            ['resource_id' => 4, 'stored' => 0, 'abundance' => 100],
            ['resource_id' => 5, 'stored' => 52, 'abundance' => 0],
            ['resource_id' => 6, 'stored' => 40, 'abundance' => 0],
            ['resource_id' => 7, 'stored' => 20000, 'abundance' => 0],
        ]);
    }
}
