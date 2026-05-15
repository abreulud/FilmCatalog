<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            ['nome' => 'Ação'],
            ['nome' => 'Comédia'],
            ['nome' => 'Drama'],
            ['nome' => 'Ficção Científica'],
            ['nome' => 'Terror'],
            ['nome' => 'Animação'],
            ['nome' => 'Documentário'],
            ['nome' => 'Romance']
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }

        $this->command->info(count($categorias) . ' categorias criadas.');
    }
}