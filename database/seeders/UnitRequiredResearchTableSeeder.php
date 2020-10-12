<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnitRequiredResearchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unit_required_research')->insert([
            ['unit_id' => 8, 'research_id' => 18],
            ['unit_id' => 9, 'research_id' => 19],
            ['unit_id' => 10, 'research_id' => 20],
            ['unit_id' => 4, 'research_id' => 22],
            ['unit_id' => 5, 'research_id' => 23],
            ['unit_id' => 6, 'research_id' => 24],
        ]);
    }
}
