<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Model::unguard();

        $this->call(BuildingTableSeeder::class);
        $this->call(ConfigTableSeeder::class);
        $this->call(ResourceTableSeeder::class);
        $this->call(ResearchTableSeeder::class);
        $this->call(RulerTableSeeder::class);
        $this->call(UnitTableSeeder::class);

        $this->call(GalaxyStartingResourcesTableSeeder::class);
        $this->call(PlanetStartingResourcesTableSeeder::class);
        $this->call(PlanetStartingBuildingsTableSeeder::class);

        // Cal these in the right order or bad stuff happens
        $this->call(GalaxyTableSeeder::class);
        $this->call(SystemTableSeeder::class);
        $this->call(PlanetTableSeeder::class);
        $this->call(PlanetResourceTableSeeder::class);

        $this->call(BuildingResourceTableSeeder::class);
        $this->call(BuildingRequiredBuildingsTableSeeder::class);
        $this->call(BuildingRequiredResearchTableSeeder::class);

        $this->call(ConversionResourceTableSeeder::class);
        $this->call(ConversionRequiredBuildingsTableSeeder::class);
        $this->call(ConversionRequiredResearchTableSeeder::class);

        $this->call(ResearchResourceTableSeeder::class);
        $this->call(ResearchRequiredResearchTableSeeder::class);

        $this->call(ResourceTaxesTableSeeder::class);

        $this->call(UnitResourceTableSeeder::class);
        $this->call(UnitRequiredResearchTableSeeder::class);

        $this->call(PlanetColoBuildingsTableSeeder::class);
        $this->call(PlanetColoResourcesTableSeeder::class);

        Model::reguard();
    }
}
