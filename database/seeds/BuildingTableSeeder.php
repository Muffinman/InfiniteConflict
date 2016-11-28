<?php

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
            ['name' => 'Metal Mine',                'turns' => 4,    'max' => NULL,  'demolish_turns' => 1],
            ['name' => 'Core Metal Mine',           'turns' => 8,    'max' => NULL,  'demolish_turns' => 2],
            ['name' => 'Strip Metal Mine',          'turns' => 24,   'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Metal Refinery',            'turns' => 24,   'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Mineral Extractor',         'turns' => 4,    'max' => NULL,  'demolish_turns' => 1],
            ['name' => 'Core Mineral Extractor',    'turns' => 8,    'max' => NULL,  'demolish_turns' => 2],
            ['name' => 'Strip Mineral Extractor',   'turns' => 24,   'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Mineral Processor',         'turns' => 24,   'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Farm',                      'turns' => 4,    'max' => NULL,  'demolish_turns' => 1],
            ['name' => 'Hydroponics Lab',           'turns' => 8,    'max' => NULL,  'demolish_turns' => 2],
            ['name' => 'Hydroponics Dome',          'turns' => 24,   'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Food Purifier',             'turns' => 24,   'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Solar Generator',           'turns' => 4,    'max' => NULL,  'demolish_turns' => 1],
            ['name' => 'Solar Array',               'turns' => 8,    'max' => NULL,  'demolish_turns' => 2],
            ['name' => 'Solar Station',             'turns' => 24,   'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Energy Booster',            'turns' => 24,   'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Outpost',                   'turns' => NULL, 'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Colony',                    'turns' => 24,   'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Metropolis',                'turns' => 48,   'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Living Quarters',           'turns' => 6,    'max' => NULL,  'demolish_turns' => 1],
            ['name' => 'Habitat',                   'turns' => 6,    'max' => NULL,  'demolish_turns' => 1],
            ['name' => 'Leisure Centre',            'turns' => 8,    'max' => 1,     'demolish_turns' => 2],
            ['name' => 'Hospital',                  'turns' => 16,   'max' => 1,     'demolish_turns' => 4],
            ['name' => 'Research Lab',              'turns' => 14,   'max' => 1,     'demolish_turns' => 4],
            ['name' => 'Launch Site',               'turns' => 8,    'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Hyperspace Beacon',         'turns' => 24,   'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Jump Gate',                 'turns' => 48,   'max' => 1,     'demolish_turns' => NULL],
            ['name' => 'Comms Satellite',           'turns' => 8,    'max' => 1,     'demolish_turns' => 4],
            ['name' => 'Ship Yard',                 'turns' => 12,   'max' => 1,     'demolish_turns' => 6],
            ['name' => 'Space Docks',               'turns' => 24,   'max' => 1,     'demolish_turns' => 12],
            ['name' => 'Light Weapons Factory',     'turns' => 12,   'max' => 1,     'demolish_turns' => 6],
            ['name' => 'Heavy Weapons Factory',     'turns' => 24,   'max' => 1,     'demolish_turns' => 12],
            ['name' => 'Army Barracks',             'turns' => 8,    'max' => 1,     'demolish_turns' => 4],
            ['name' => 'Land Reclamation',          'turns' => 24,   'max' => NULL,  'demolish_turns' => NULL],
            ['name' => 'Orbital Clearing',          'turns' => 24,   'max' => NULL,  'demolish_turns' => NULL],
        ]);
    }
}
