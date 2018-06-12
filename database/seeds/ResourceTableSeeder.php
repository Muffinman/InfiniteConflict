<?php

use Illuminate\Database\Seeder;

class ResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resources')->insert([
            [
                'name'                => 'Metal',
                'hp'                  => 0,
                'ap'                  => 0,
                'creatable'           => 0,
                'transferable'        => 1,
                'turns'               => 0,
                'interest'            => 0,
                'requires_storage'    => 0,
                'global'              => 0,
                'production_resource' => 1,
            ],
            [
                'name'                => 'Mineral',
                'hp'                  => 0,
                'ap'                  => 0,
                'creatable'           => 0,
                'transferable'        => 1,
                'turns'               => 0,
                'interest'            => 0,
                'requires_storage'    => 0,
                'global'              => 0,
                'production_resource' => 1,
            ],
            [
                'name'                => 'Food',
                'hp'                  => 0,
                'ap'                  => 0,
                'creatable'           => 0,
                'transferable'        => 1,
                'turns'               => 0,
                'interest'            => 0,
                'requires_storage'    => 0,
                'global'              => 0,
                'production_resource' => 1,
            ],
            [
                'name'                => 'Energy',
                'hp'                  => 0,
                'ap'                  => 0,
                'creatable'           => 0,
                'transferable'        => 1,
                'turns'               => 0,
                'interest'            => 0,
                'requires_storage'    => 0,
                'global'              => 0,
                'production_resource' => 1,
            ],
            [
                'name'                => 'Ground Space',
                'hp'                  => 0,
                'ap'                  => 0,
                'creatable'           => 0,
                'transferable'        => 0,
                'turns'               => 0,
                'interest'            => 0,
                'requires_storage'    => 0,
                'global'              => 0,
                'production_resource' => 0,
            ],
            [
                'name'                => 'Orbital Space',
                'hp'                  => 0,
                'ap'                  => 0,
                'creatable'           => 0,
                'transferable'        => 0,
                'turns'               => 0,
                'interest'            => 0,
                'requires_storage'    => 0,
                'global'              => 0,
                'production_resource' => 0,
            ],
            [
                'name'                => 'Worker',
                'hp'                  => 2,
                'ap'                  => 0,
                'creatable'           => 0,
                'transferable'        => 1,
                'turns'               => 0,
                'interest'            => 1,
                'requires_storage'    => 1,
                'global'              => 0,
                'production_resource' => 0,
            ],
            [
                'name'                => 'Soldier',
                'hp'                  => 30,
                'ap'                  => 20,
                'creatable'           => 1,
                'transferable'        => 1,
                'turns'               => 4,
                'interest'            => 0,
                'requires_storage'    => 0,
                'global'              => 0,
                'production_resource' => 0,
            ],
            [
                'name'                => 'Scientist',
                'hp'                  => 1,
                'ap'                  => 0,
                'creatable'           => 1,
                'transferable'        => 1,
                'turns'               => 8,
                'interest'            => 0,
                'requires_storage'    => 1,
                'global'              => 0,
                'production_resource' => 0,
            ],
            [
                'name'                => 'Research Points',
                'hp'                  => 0,
                'ap'                  => 0,
                'creatable'           => 0,
                'transferable'        => 0,
                'turns'               => 0,
                'interest'            => 0,
                'requires_storage'    => 0,
                'global'              => 1,
                'production_resource' => 0,
            ],
        ]);
    }
}
