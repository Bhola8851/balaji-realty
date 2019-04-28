<?php

use Faker\Generator as Faker;

$factory->define(App\snacks\Customer::class, function (Faker $faker) {
        return [
            'customer_name' => $faker->name,
            'customer_contact' => $faker->unique()->e164phoneNumber,
            'customer_email' => $faker->unique()->email,
            'customer_address' => $faker->address,
            'customer_description' => $faker->paragraph
        ];

});
