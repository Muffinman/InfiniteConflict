<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConversionRequiredBuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conversion_required_buildings')->insert([
            ['resource_id' => 9, 'building_id' => 24],
            ['resource_id' => 8, 'building_id' => 33],
        ]);
    }
}
