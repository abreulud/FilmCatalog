<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategoriaSeeder::class,
            FilmeSeeder::class,
        ]);
    }
}