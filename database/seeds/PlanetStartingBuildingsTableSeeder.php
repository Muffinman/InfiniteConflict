<?php

use Illuminate\Database\Seeder;

class PlanetStartingBuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planet_starting_buildings')->insert([
            ['building_id' => 1, 'qty' => 3],
            ['building_id' => 5, 'qty' => 3],
            ['building_id' => 9, 'qty' => 1],
            ['building_id' => 13, 'qty' => 1],
            ['building_id' => 17, 'qty' => 1],
        ]);
    }
}