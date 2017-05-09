<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\User::class, function(Faker\Generator $faker){
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'username' => $faker->unique()->safeEmail,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
        'remember_token' => str_random(10),
        'terms_and_policy' => true,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Building::class, function(Faker\Generator $faker){

    $counties = ['Derry', 'Tyrone', 'Fermanagh', 'Armagh', 'Antrim', 'Down'];
    $faker = Faker\Factory::create('en_GB');
    return [
        'name' => $faker->word,
        'address_1' => $faker->streetAddress,
        'town_city' => $faker->city,
        'county' => $counties[rand(0,5)],
        'country' => 'Northern Ireland',
        'latitude' => $faker->latitude(54.110037, 55.371990),
        'longitude' => $faker->longitude(-5.701904, -7.976074)
    ];
});