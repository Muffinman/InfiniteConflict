<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanetColoResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planet_colo_resources')->insert([
            ['resource_id' => 1, 'qty' => 6000],
            ['resource_id' => 2, 'qty' => 4000],
            ['resource_id' => 3, 'qty' => 2000],
            ['resource_id' => 7, 'qty' => 5000],
        ]);
    }
}
