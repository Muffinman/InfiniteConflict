<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UnitRequiredBuildingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unit_required_buildings')->insert([
            ['unit_id' => 1, 'requirement_id' => 29, 'qty' => 1], // Fighter / Ship Yard
            ['unit_id' => 1, 'requirement_id' => 31, 'qty' => 1], // Fighter / Light Weapons Factory
            ['unit_id' => 2, 'requirement_id' => 29, 'qty' => 1], // Bomber / Ship Yard
            ['unit_id' => 2, 'requirement_id' => 31, 'qty' => 1], // Bomber / Light Weapons Factory
            ['unit_id' => 3, 'requirement_id' => 29, 'qty' => 1], // Frigate / Ship Yard
            ['unit_id' => 3, 'requirement_id' => 31, 'qty' => 1], // Frigate / Light Weapons Factory
            ['unit_id' => 4, 'requirement_id' => 29, 'qty' => 1], // Destroyer / Ship Yard
            ['unit_id' => 4, 'requirement_id' => 32, 'qty' => 1], // Destroyer / Heavy Weapons Factory
            ['unit_id' => 5, 'requirement_id' => 30, 'qty' => 1], // Cruiser / Space Dock
            ['unit_id' => 5, 'requirement_id' => 31, 'qty' => 1], // Cruiser / Light Weapons Factory
            ['unit_id' => 6, 'requirement_id' => 30, 'qty' => 1], // Battleship / Space Dock
            ['unit_id' => 6, 'requirement_id' => 32, 'qty' => 1], // Battleship / Heavy Weapons Factory
            ['unit_id' => 7, 'requirement_id' => 29, 'qty' => 1], // Freighter / Ship Yard
            ['unit_id' => 8, 'requirement_id' => 29, 'qty' => 1], // Merchant / Ship Yard
            ['unit_id' => 9, 'requirement_id' => 29, 'qty' => 1], // Trader / Ship Yard
            ['unit_id' => 10, 'requirement_id' => 29, 'qty' => 1], // Hulk / Ship Yard
            ['unit_id' => 10, 'requirement_id' => 30, 'qty' => 1], // Hulk / Space Dock
            ['unit_id' => 11, 'requirement_id' => 29, 'qty' => 1], // Invasion Ship / Ship Yard
            ['unit_id' => 11, 'requirement_id' => 31, 'qty' => 1], // Invasion Ship / Light Weapons Factory
            ['unit_id' => 12, 'requirement_id' => 29, 'qty' => 1], // Outpost Ship / Ship Yard
        ]);
    }
}
