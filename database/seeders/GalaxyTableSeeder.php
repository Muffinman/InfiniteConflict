<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;
use DB;

class GalaxyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num_gals = Config::find('gals')->value;
        $gal_types = Config::find('gal_types')->value;

        $home_gal_cols = Config::find('home_gal_cols')->value;
        $home_gal_rows = Config::find('home_gal_rows')->value;

        $free_gal_cols = Config::find('free_gal_cols')->value;
        $free_gal_rows = Config::find('free_gal_rows')->value;

        for ($i = 0; $i < $num_gals; $i++) {
            $home = ($i + 1) % 2;
            DB::table('galaxies')->insert([
                'home' => $home,
                'cols' => ($home ? $home_gal_cols : $free_gal_cols),
                'rows' => ($home ? $home_gal_rows : $free_gal_rows),
                'type' => rand(1, $gal_types),
            ]);
        }
    }
}
