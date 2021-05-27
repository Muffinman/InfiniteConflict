<?php

namespace Database\Seeders;

use App\Models\Config;
use App\Models\GalaxyStartingResource;
use App\Models\PlanetStartingResource;
use App\Models\System;
use Illuminate\Database\Seeder;
use DB;

class PlanetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $planet_types = Config::find('planet_types')->value;

        $home_sys_cols = Config::find('home_sys_cols')->value;
        $home_sys_rows = Config::find('home_sys_rows')->value;

        $free_sys_cols = Config::find('free_sys_cols')->value;
        $free_sys_rows = Config::find('free_sys_rows')->value;

        $this->command->getOutput()->writeln('<info>Seeding planets</info>...');
        $this->command->getOutput()->progressStart(System::count());

        System::chunk(200, function ($systems) use ($planet_types, $home_sys_cols, $home_sys_rows, $free_sys_cols, $free_sys_rows) {
            $planets = [];

            foreach ($systems as $sys) {
                $gal = $sys->galaxy;
                $total_planets = $sys->galaxy->home ? ($home_sys_cols * $home_sys_rows) : ($free_sys_cols * $free_sys_rows);

                for ($i = 0; $i < $total_planets; $i++) {
                    if ($sys->home) {
                        $row = floor($i / $home_sys_cols) + 1;
                        $col = ($i % $home_sys_cols) + 1;
                    } else {
                        $row = floor($i / $free_sys_cols) + 1;
                        $col = ($i % $free_sys_cols) + 1;
                    }

                    $planets[] = [
                        'system_id' => $sys->id,
                        'galaxy_id' => $gal->id,
                        'row'       => $row,
                        'col'       => $col,
                        'home'      => $sys->home,
                        'type'      => rand(1, $planet_types),
                    ];
                }
                $this->command->getOutput()->progressAdvance();
            }

            DB::table('planets')->insert($planets);
        });

        $this->command->getOutput()->progressFinish();
    }
}
