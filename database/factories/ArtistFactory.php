<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Artist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->lastName,
            'firstname' => $this->faker->firstname,
            'birthdate' => $this->faker->numberBetween(1901, 2010),
            'country_id' => Country::all()->random()->id
        ];
    }
}
