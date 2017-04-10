<?php

use Faker\Factory as Faker;

class ModelTableSeeder extends Seeder {

    public function run() {
        $faker = Faker::create();

        $users = User::all()->lists('id');
        foreach(range(1, 50) as $index) {
            NewModel::create([
            	'user_id' => $faker->randomElement($users),
                'firstName'     => $faker->firstName($gender = null|'male'|'female'),
                'lastName'     => $faker->lastName,
                'displayName'     => $faker->name($gender = null|'male'|'female'),
                'gender'     => $faker->randomElement($array = array ('male','female')),
                'phone'     => $faker->phoneNumber,
                'Height'     => $faker->numberBetween($min = 120, $max = 210),
                'about'     => $faker->text($maxNbChars = 100),
                'DayofBirth'     => $faker->numberBetween($min = 1, $max = 30),
                'MonthOfBirth'     => $faker->numberBetween($min = 1, $max = 12),
                'YearofBirth'     => $faker->numberBetween($min = 1954, $max = 2004),
                'location'     => $faker->randomElement($array = array ('Edo','Rivers', 'Ebonyi', 'Bayelsa'))
            ]);
        }
    }
}