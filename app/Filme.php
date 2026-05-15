<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    protected $fillable = ['titulo', 'sinopse', 'diretor', 'duracao', 'classificacao', 'nota', 'ano_lancamento', 'categoria_id'];

    protected $casts = [
        'nota'           => 'float',
        'ano_lancamento' => 'integer',
        'duracao'=> 'integer',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}

