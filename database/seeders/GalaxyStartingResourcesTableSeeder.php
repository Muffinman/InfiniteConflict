<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class GalaxyStartingResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('galaxy_starting_resources')->insert([
            ['resource_id' => 1, 'home_min_stored' => 0, 'home_max_stored' => 0, 'home_min_abundance' => 30, 'home_max_abundance' => 60, 'free_min_stored' => 0, 'free_max_stored' => 0, 'free_min_abundance' => 50, 'free_max_abundance' => 100],
            ['resource_id' => 2, 'home_min_stored' => 0, 'home_max_stored' => 0, 'home_min_abundance' => 30, 'home_max_abundance' => 60, 'free_min_stored' => 0, 'free_max_stored' => 0, 'free_min_abundance' => 50, 'free_max_abundance' => 100],
            ['resource_id' => 3, 'home_min_stored' => 0, 'home_max_stored' => 0, 'home_min_abundance' => 30, 'home_max_abundance' => 60, 'free_min_stored' => 0, 'free_max_stored' => 0, 'free_min_abundance' => 50, 'free_max_abundance' => 100],
            ['resource_id' => 4, 'home_min_stored' => 0, 'home_max_stored' => 0, 'home_min_abundance' => 30, 'home_max_abundance' => 60, 'free_min_stored' => 0, 'free_max_stored' => 0, 'free_min_abundance' => 50, 'free_max_abundance' => 100],
            ['resource_id' => 5, 'home_min_stored' => 20, 'home_max_stored' => 50, 'home_min_abundance' => 0, 'home_max_abundance' => 0, 'free_min_stored' => 50, 'free_max_stored' => 100, 'free_min_abundance' => 0, 'free_max_abundance' => 0],
            ['resource_id' => 6, 'home_min_stored' => 20, 'home_max_stored' => 50, 'home_min_abundance' => 0, 'home_max_abundance' => 0, 'free_min_stored' => 50, 'free_max_stored' => 100, 'free_min_abundance' => 0, 'free_max_abundance' => 0],
        ]);
    }
}
