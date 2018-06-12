<?php

use Illuminate\Database\Seeder;

class RulerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rulers')->insert([
            'name'     => 'Muffinman',
            'email'    => 'matt@azmatt.co.uk',
            'password' => '$2y$10$bPKSEzh/8xa9dmpFIaTTbeYGJDVJnE3Xbd2HRaPWhRSXcMJNfglUa',
        ]);
    }
}
