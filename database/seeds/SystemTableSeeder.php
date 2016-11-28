<?php

use Illuminate\Database\Seeder;

use App\Config;
use App\Galaxy;

class SystemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sys_types = Config::find('sys_types')->value;

        $home_gal_cols = Config::find('home_gal_cols')->value;
        $home_gal_rows = Config::find('home_gal_rows')->value;

        $free_gal_cols = Config::find('free_gal_cols')->value;
        $free_gal_rows = Config::find('free_gal_rows')->value;

        $home_sys_cols = Config::find('home_sys_cols')->value;
        $home_sys_rows = Config::find('home_sys_rows')->value;

        $free_sys_cols = Config::find('free_sys_cols')->value;
        $free_sys_rows = Config::find('free_sys_rows')->value;

        // how many rows of systems at the top of the galaxy are considered 'home planet starting locations'
        $home_gal_hp_rows = Config::find('home_gal_hp_rows')->value; 

        foreach (Galaxy::all() as $gal) {

            $total_systems = $gal->home ? ($home_gal_cols * $home_gal_rows) : ($free_gal_cols * $free_gal_rows);

            for ($i=0; $i<$total_systems; $i++) {

                if ($gal->home){
                    $row = floor($i / $home_gal_cols) + 1;
                    $col = ($i % $home_gal_cols) + 1;
                }else{
                    $row = floor($i / $free_gal_cols) + 1;
                    $col = ($i % $free_gal_cols) + 1;
                }

                DB::table('systems')->insert([
                    'galaxy_id' => $gal->id,
                    'cols' => ($gal->home ? $home_sys_cols : $free_sys_cols),
                    'rows' => ($gal->home ? $home_sys_rows : $free_sys_rows),
                    'row' => $row,
                    'col' => $col,
                    'home' => ($row <= $home_gal_hp_rows ? 1 : 0),
                    'type' => rand(1, $sys_types),
                ]);
            }
        }

    }
}
