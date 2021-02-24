<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Movie;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        Movie::factory()
                ->count(100)
                ->create();
        */

        DB::table('movies')->insert([
            [
                'title' => 'Jurassic Park',
                'year' => 1993,
                'country_id' => 1,
            ],[
                'title' => 'Raiders of the Lost Ark',
                'year' => 1981,
                'country_id' => 1,
            ],[
                'title' => 'Star Wars: A new Hope',
                'year' => 1977,
                'country_id' => 1,
            ],[
                'title' => 'Mad Max: Fury Road',
                'year' => 2015,
                'country_id' => 2,
            ],
        ]);
    }
}
