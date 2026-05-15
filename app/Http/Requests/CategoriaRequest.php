<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Qualquer usuário autenticado pode fazer isso
    }

    public function rules(): array
    {
        return [
            'nome'     => 'required|string|max:100|unique:categorias,nome,' . $this->route('id'),
            'descricao'=> 'nullable|string|max:500',
            'ativo'    => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.unique'   => 'Já existe uma categoria com este nome.',
            'nome.max'      => 'O nome não pode ter mais de 100 caracteres.',
        ];
    }
}