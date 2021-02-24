<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Artist;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        Artist::factory()
                ->count(500)
                ->create();
        */

        DB::table('artists')->insert([
            [
                'name' => 'Coppola',
                'firstname' => 'Francis Ford',
                'birthdate' => 1939,
                'country_id' => 1,
            ],[
                'name' => 'Lynch',
                'firstname' => 'David',
                'birthdate' => 1946,
                'country_id' => 1,
            ], [
                'name' => 'Leto',
                'firstname' => 'Jared',
                'birthdate' => 1971,
                'country_id' => 1,
            ],[
                'name' => 'Spielberg',
                'firstname' => 'Steven',
                'birthdate' => 1946,
                'country_id' => 1,
            ], [
                'name' => 'Theron',
                'firstname' => 'Charlize',
                'birthdate' => 1975,
                'country_id' => 2,
            ],[
                'name' => 'Ford',
                'firstname' => 'Harrison',
                'birthdate' => 1942,
                'country_id' => 1,
            ], [
                'name' => 'Lucas',
                'firstname' => 'George',
                'birthdate' => 1948,
                'country_id' => 1,
            ], [
                'name' => 'Hamill',
                'firstname' => 'Mark',
                'birthdate' => 1951,
                'country_id' => 1,
            ], [
                'name' => 'Neill',
                'firstname' => 'Sam',
                'birthdate' => 1947,
                'country_id' => 1,
            ],
        ]);
    }
}
