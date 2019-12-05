<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use App\Collaborator;
use App\Role;
use Faker\Generator as Faker;

$factory->define(Collaborator::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->email,
        'city_id' => factory(City::class)->create()->id,
        'role_id' => factory(Role::class)->create()->id,
        'disabled_at' => null,
    ];
});
