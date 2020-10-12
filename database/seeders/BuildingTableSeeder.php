<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BuildingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buildings')->insert([
            ['name' => 'Metal Mine',                'turns' => 4,    'max' => null,  'demolish_turns' => 1],
            ['name' => 'Core Metal Mine',           'turns' => 8,    'max' => null,  'demolish_turns' => 2],
            ['name' => 'Strip Metal Mine',          'turns' => 24,   'max' => 1,     'demolish_turns' => null],
            ['name' => 'Metal Refinery',            'turns' => 24,   'max' => 1,     'demolish_turns' => null],
            ['name' => 'Mineral Extractor',         'turns' => 4,    'max' => null,  'demolish_turns' => 1],
            ['name' => 'Core Mineral Extractor',    'turns' => 8,    'max' => null,  'demolish_turns' => 2],
            ['name' => 'Strip Mineral Extractor',   'turns' => 24,   'max' => 1,     'demolish_turns' => null],
            ['name' => 'Mineral Processor',         'turns' => 24,   'max' => 1,     'demolish_turns' => null],
            ['name' => 'Farm',                      'turns' => 4,    'max' => null,  'demolish_turns' => 1],
            ['name' => 'Hydroponics Lab',           'turns' => 8,    'max' => null,  'demolish_turns' => 2],
            ['name' => 'Hydroponics Dome',          'turns' => 24,   'max' => 1,     'demolish_turns' => null],
            ['name' => 'Food Purifier',             'turns' => 24,   'max' => 1,     'demolish_turns' => null],
            ['name' => 'Solar Generator',           'turns' => 4,    'max' => null,  'demolish_turns' => 1],
            ['name' => 'Solar Array',               'turns' => 8,    'max' => null,  'demolish_turns' => 2],
            ['name' => 'Solar Station',             'turns' => 24,   'max' => 1,     'demolish_turns' => null],
            ['name' => 'Energy Booster',            'turns' => 24,   'max' => 1,     'demolish_turns' => null],
            ['name' => 'Outpost',                   'turns' => null, 'max' => 1,     'demolish_turns' => null],
            ['name' => 'Colony',                    'turns' => 24,   'max' => 1,     'demolish_turns' => null],
            ['name' => 'Metropolis',                'turns' => 48,   'max' => 1,     'demolish_turns' => null],
            ['name' => 'Living Quarters',           'turns' => 6,    'max' => null,  'demolish_turns' => 1],
            ['name' => 'Habitat',                   'turns' => 6,    'max' => null,  'demolish_turns' => 1],
            ['name' => 'Leisure Centre',            'turns' => 8,    'max' => 1,     'demolish_turns' => 2],
            ['name' => 'Hospital',                  'turns' => 16,   'max' => 1,     'demolish_turns' => 4],
            ['name' => 'Research Lab',              'turns' => 14,   'max' => 1,     'demolish_turns' => 4],
            ['name' => 'Launch Site',               'turns' => 8,    'max' => 1,     'demolish_turns' => null],
            ['name' => 'Hyperspace Beacon',         'turns' => 24,   'max' => 1,     'demolish_turns' => null],
            ['name' => 'Jump Gate',                 'turns' => 48,   'max' => 1,     'demolish_turns' => null],
            ['name' => 'Comms Satellite',           'turns' => 8,    'max' => 1,     'demolish_turns' => 4],
            ['name' => 'Ship Yard',                 'turns' => 12,   'max' => 1,     'demolish_turns' => 6],
            ['name' => 'Space Docks',               'turns' => 24,   'max' => 1,     'demolish_turns' => 12],
            ['name' => 'Light Weapons Factory',     'turns' => 12,   'max' => 1,     'demolish_turns' => 6],
            ['name' => 'Heavy Weapons Factory',     'turns' => 24,   'max' => 1,     'demolish_turns' => 12],
            ['name' => 'Army Barracks',             'turns' => 8,    'max' => 1,     'demolish_turns' => 4],
            ['name' => 'Land Reclamation',          'turns' => 24,   'max' => null,  'demolish_turns' => null],
            ['name' => 'Orbital Clearing',          'turns' => 24,   'max' => null,  'demolish_turns' => null],
        ]);
    }
}
