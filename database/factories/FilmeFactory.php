<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Filme;
use Faker\Generator as Faker;

$factory->define(Filme::class, function (Faker $faker) {
    return [
        'titulo' => $faker->sentence,
        'descricao' => $faker->paragraph,
        'categoria_id' => \App\Categoria::inRandomOrder()->first()->id,
    ];
});
