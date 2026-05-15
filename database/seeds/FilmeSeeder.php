<?php

use Illuminate\Database\Seeder;
use App\Filme;
use App\Categoria;

class FilmeSeeder extends Seeder
{
    public function run()
    {
        $acao      = Categoria::where('nome', 'Ação')->first()->id;
        $drama     = Categoria::where('nome', 'Drama')->first()->id;
        $ficcao    = Categoria::where('nome', 'Ficção Científica')->first()->id;
        $animacao  = Categoria::where('nome', 'Animação')->first()->id;

        $filmes = [
            [
                'titulo'         => 'Matrix',
                'sinopse'        => 'Um hacker descobre que a realidade é uma simulação.',
                'ano_lancamento' => 1999,
                'diretor'        => 'Lana e Lilly Wachowski',
                'duracao'        => 136,
                'nota'           => 8.7,
                'classificacao'  => '16 anos',
                'categoria_id'   => $ficcao,
            ],
            [
                'titulo'         => 'O Poderoso Chefão',
                'sinopse'        => 'A saga da família Corleone no mundo do crime organizado.',
                'ano_lancamento' => 1972,
                'diretor'        => 'Francis Ford Coppola',
                'duracao'        => 175,
                'nota'           => 9.2,
                'classificacao'  => '16 anos',
                'categoria_id'   => $drama,
            ],
            [
                'titulo'         => 'Homem de Aranha',
                'sinopse'        => 'Peter Parker ganha superpoderes de uma aranha misteriosa e enfrenta o vilões.',
                'ano_lancamento' => 2008,
                'diretor'        => 'Jon Favreau',
                'duracao'        => 126,
                'nota'           => 7.9,
                'classificacao'  => '12 anos',
                'categoria_id'   => $acao,
            ],
            [
                'titulo'         => 'Toy Story',
                'sinopse'        => 'Os brinquedos ganham vida quando os humanos não estão por perto.',
                'ano_lancamento' => 1995,
                'diretor'        => 'John Lasseter',
                'duracao'        => 81,
                'nota'           => 8.3,
                'classificacao'  => 'Livre',
                'categoria_id'   => $animacao,
            ],
        ];

        foreach ($filmes as $filme) {
            Filme::create($filme);
        }

        $this->command->info(count($filmes) . ' filmes criados.');
    }
}