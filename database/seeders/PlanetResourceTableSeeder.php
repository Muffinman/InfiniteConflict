<?php

namespace Database\Seeders;

use App\Models\GalaxyStartingResource;
use App\Models\Planet;
use App\Models\PlanetStartingResource;
use App\Models\Resource;
use Illuminate\Database\Seeder;
use DB;

class PlanetResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resources = Resource::all();
        $galaxy_resources = GalaxyStartingResource::allAsResourceArray();
        $planet_resources = PlanetStartingResource::allAsResourceArray();

        $this->command->getOutput()->writeln('<info>Seeding planet resources</info>...');
        $this->command->getOutput()->progressStart(Planet::withoutGlobalScopes()->count());

        Planet::withoutGlobalScopes()->chunk(200, function ($planets) use ($resources, $galaxy_resources, $planet_resources) {
            /**
             * @var Planet $planet
             */
            foreach ($planets as $planet) {
                $planet->attachStartingResources($resources, $galaxy_resources, $planet_resources);
            }
            $this->command->getOutput()->progressAdvance(count($planets));
        });

        $this->command->getOutput()->progressFinish();
    }
}
