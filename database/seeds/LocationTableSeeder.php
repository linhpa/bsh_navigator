<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Location::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Location::create([
            	'gdv' => $faker->sentence,
            	'phone' => $faker->sentence,
                'lat' => $faker->sentence,
                'lng' => $faker->paragraph,
            ]);
        }
    }
}
