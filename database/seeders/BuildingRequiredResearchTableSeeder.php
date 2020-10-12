<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BuildingRequiredResearchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('building_required_research')->insert([
            ['building_id' => 2,  'research_id' => 4],
            ['building_id' => 6,  'research_id' => 5],
            ['building_id' => 10, 'research_id' => 6],
            ['building_id' => 14, 'research_id' => 7],
            ['building_id' => 3,  'research_id' => 10],
            ['building_id' => 7,  'research_id' => 11],
            ['building_id' => 11, 'research_id' => 12],
            ['building_id' => 15, 'research_id' => 13],
            ['building_id' => 4,  'research_id' => 14],
            ['building_id' => 8,  'research_id' => 15],
            ['building_id' => 12, 'research_id' => 16],
            ['building_id' => 16, 'research_id' => 17],
            ['building_id' => 26, 'research_id' => 26],
            ['building_id' => 27, 'research_id' => 27],
        ]);
    }
}
