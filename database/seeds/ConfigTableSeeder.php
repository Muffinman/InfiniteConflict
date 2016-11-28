<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config')->insert([
            ['key' => 'turn',               'value' => 94],
            ['key' => 'update',             'value' => 1],
            ['key' => 'gals',               'value' => 6],
            ['key' => 'home_gal_cols',      'value' => 20],
            ['key' => 'home_gal_rows',      'value' => 10],
            ['key' => 'free_gal_cols',      'value' => 20],
            ['key' => 'free_gal_rows',      'value' => 10],
            ['key' => 'home_sys_cols',      'value' => 5],
            ['key' => 'home_sys_rows',      'value' => 2],
            ['key' => 'free_sys_cols',      'value' => 5],
            ['key' => 'free_sys_rows',      'value' => 1],
            ['key' => 'gal_types',          'value' => 7],
            ['key' => 'sys_types',          'value' => 8],
            ['key' => 'planet_types',       'value' => 45],
            ['key' => 'home_gal_hp_rows',   'value' => 3],
            ['key' => 'turn_length',        'value' => 60],

        ]);
    }
}
