<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ResourceTaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resource_taxes')->insert([
            ['resource_id' => 7, 'output_resource' => 3, 'rate' => -0.2],
            ['resource_id' => 9, 'output_resource' => 10, 'rate' => 100],
        ]);
    }
}
