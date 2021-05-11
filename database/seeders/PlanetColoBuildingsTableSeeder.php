<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PlanetColoBuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planet_colo_buildings')->insert([
            ['building_id' => 17, 'qty' => 1],
        ]);
    }
}
