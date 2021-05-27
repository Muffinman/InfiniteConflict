<?php

namespace Database\Factories;

use App\Models\Galaxy;
use App\Models\GalaxyStartingResource;
use App\Models\Planet;
use App\Models\PlanetStartingResource;
use App\Models\Resource;
use App\Models\Ruler;
use App\Models\System;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Planet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->words(rand(1,3), true),
            'ruler_id' => Ruler::inRandomOrder()->first()->id,
            'galaxy_id' => Galaxy::inRandomOrder()->first()->id,
            'system_id' => System::inRandomOrder()->first()->id,
            'col' => rand(1, 5),
            'row' => rand(1, 2),
            'home' => rand(0, 1),
            'type' => rand(1, 45),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        $resources = Resource::all();
        $galaxy_resources = GalaxyStartingResource::allAsResourceArray();
        $planet_resources = PlanetStartingResource::allAsResourceArray();

        return $this->afterMaking(function (Planet $planet) use ($resources, $galaxy_resources, $planet_resources) {
            $planet->attachStartingResources($resources, $galaxy_resources, $planet_resources);
        })->afterCreating(function (Planet $planet) use ($resources, $galaxy_resources, $planet_resources) {
            $planet->attachStartingResources($resources, $galaxy_resources, $planet_resources);
        });
    }
}
