<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo'          => 'required|string|max:200',
            'sinopse'         => 'nullable|string',
            'ano_lancamento'  => 'required|integer|min:1888|max:' . (date('Y') + 2),
            'diretor'         => 'nullable|string|max:150',
            'duracao' => 'nullable|integer|min:1|max:600',
            'nota'            => 'nullable|numeric|min:0|max:10',
            'classificacao'   => 'nullable|string|max:10',
            'categoria_id'    => 'required|integer|exists:categorias,id',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required'        => 'O título do filme é obrigatório.',
            'ano_lancamento.required'=> 'O ano de lançamento é obrigatório.',
            'ano_lancamento.min'     => 'O ano de lançamento não pode ser anterior a 1888.',
            'nota.max'               => 'A nota deve ser entre 0 e 10.',
            'categoria_id.required'  => 'A categoria é obrigatória.',
            'categoria_id.exists'    => 'A categoria informada não existe.',
        ];
    }
}