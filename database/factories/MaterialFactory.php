<?php

use Faker\Generator as Faker;
use App\snacks\Customer;

$factory->define(App\snacks\CustomerMaterial::class, function (Faker $faker) {
    return [
        'customer_id' => function(){
            return Customer::all()->random();
        },
        'material_name' => $faker->lexify('Material:  ???????'),
        'material_quantity' => $faker->numberBetween(10,100)
    ];
});
