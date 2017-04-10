<?php

use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

    public function run() {
        $faker = Faker::create();

        foreach(range(1, 50) as $index) {
            User::create([
                'email'     => $faker->email,
                'password'   => Hash::make('uchebliss49')
            ]);
        }
    }
}