<?php

namespace App\Http\Controllers;

use App\Filme;
use App\Http\Requests\FilmeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FilmeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request): JsonResponse
    {
        $query = Filme::with('categoria');  // Eager loading — evita N+1!

        // Filtro por categoria
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        // Busca por título
        if ($request->filled('busca')) {
            $query->where(function ($q) use ($request) {
                $q->where('titulo', 'like', '%' . $request->busca . '%')
                  ->orWhere('titulo_original', 'like', '%' . $request->busca . '%')
                  ->orWhere('diretor', 'like', '%' . $request->busca . '%');
            });
        }

        // Filtro por ano
        if ($request->filled('ano')) {
            $query->where('ano_lancamento', $request->ano);
        }

        $ordenar = $request->get('ordenar', 'titulo');  
        $direcao = $request->get('direcao', 'asc');
        $camposPermitidos = ['titulo', 'ano_lancamento', 'nota', 'created_at'];

        if (in_array($ordenar, $camposPermitidos)) {
            $query->orderBy($ordenar, $direcao === 'desc' ? 'desc' : 'asc');
        }

        $filmes = $query->paginate(15);

        return response()->json($filmes);
    }


    public function store(FilmeRequest $request): JsonResponse
    {
        $filme = Filme::create($request->validated());
        $filme->load('categoria');  // Carregar o relacionamento para retornar

        return response()->json([
            'message' => 'Filme criado com sucesso.',
            'filme'   => $filme,
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $filme = Filme::with('categoria')->find($id);

        if (!$filme) {
            return response()->json(['message' => 'Filme não encontrado.'], 404);
        }

        return response()->json($filme);
    }


    public function update(FilmeRequest $request, int $id): JsonResponse
    {
        $filme = Filme::find($id);

        if (!$filme) {
            return response()->json(['message' => 'Filme não encontrado.'], 404);
        }

        $filme->update($request->validated());
        $filme->load('categoria');

        return response()->json([
            'message' => 'Filme atualizado com sucesso.',
            'filme'   => $filme,
        ]);
    }


    public function destroy(int $id): JsonResponse
    {
        $filme = Filme::find($id);

        if (!$filme) {
            return response()->json(['message' => 'Filme não encontrado.'], 404);
        }

        $filme->delete();

        return response()->json(null, 204);
    }
}