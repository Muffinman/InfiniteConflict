<?php

use App\Config;
use App\GalaxyStartingResource;
use App\Planet;
use App\PlanetStartingResource;
use App\Resource;
use Illuminate\Database\Seeder;

class PlanetResourceTableSeeder extends Seeder
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

        $resources = Resource::all();

        $galaxy_starting_resources = GalaxyStartingResource::all();
        $galaxy_resources = [];
        foreach ($galaxy_starting_resources as $res) {
            $galaxy_resources[$res['resource_id']] = $res;
        }

        $planet_starting_resources = PlanetStartingResource::all();
        $planet_resources = [];
        foreach ($planet_starting_resources as $res) {
            $planet_resources[$res['resource_id']] = $res;
        }

        $this->command->getOutput()->writeln('<info>Seeding planet resources</info>...');
        $this->command->getOutput()->progressStart(Planet::count());

        Planet::chunk(200, function ($planets) use ($resources, $galaxy_resources, $planet_resources) {
            foreach ($planets as $planet) {
                $attached_resources = [];
                foreach ($resources as $resource) {
                    $stored = $abundance = 0;

                    // Home planet in home gal
                    if ($planet->home && isset($planet_resources[$resource->id])) {
                        $stored = $planet_resources[$resource->id]['stored'];
                        $abundance = $planet_resources[$resource->id]['abundance'];
                    }

                    // Normal planet in home gal
                    elseif ($planet->galaxy->home && isset($galaxy_resources[$resource->id])) {
                        $stored = rand($galaxy_resources[$resource->id]['home_min_stored'], $galaxy_resources[$resource->id]['home_max_stored']);
                        $abundance = rand($galaxy_resources[$resource->id]['home_min_abundance'], $galaxy_resources[$resource->id]['home_max_abundance']);
                    }

                    // Normal planet in free gal
                    elseif (isset($galaxy_resources[$resource->id])) {
                        $stored = 0;
                        $abundance = rand($galaxy_resources[$resource->id]['free_min_abundance'], $galaxy_resources[$resource->id]['free_max_abundance']);
                    }

                    if ($stored !== 0 || $abundance !== 0) {
                        $attached_resources[$resource->id] = ['stored' => $stored, 'abundance' => $abundance];
                    }
                }
                $planet->resources()->attach($attached_resources);
                $this->command->getOutput()->progressAdvance();
            }
        });

        $this->command->getOutput()->progressFinish();
    }
}
