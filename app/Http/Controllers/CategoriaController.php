<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Http\JsonResponse;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * GET /api/categorias
     * Lista todas as categorias com contagem de filmes.
     */
    public function index(): JsonResponse
    {
        $categorias = Categoria::withCount('filmes')  // adiciona filmes_count
                               ->orderBy('nome')
                               ->paginate(15);

        return response()->json($categorias);
    }

    /**
     * POST /api/categorias
     * Cria uma nova categoria.
     */
    public function store(CategoriaRequest $request): JsonResponse
    {
        $categoria = Categoria::create($request->validated());

        return response()->json([
            'message'  => 'Categoria criada com sucesso.',
            'categoria'=> $categoria,
        ], 201);
    }

    /**
     * GET /api/categorias/{id}
     * Exibe uma categoria com seus filmes.
     */
    public function show(int $id): JsonResponse
    {
        $categoria = Categoria::with('filmes')->find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoria não encontrada.'], 404);
        }

        return response()->json($categoria);
    }

    /**
     * PUT /api/categorias/{id}
     * Atualiza uma categoria.
     */
    public function update(CategoriaRequest $request, int $id): JsonResponse
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoria não encontrada.'], 404);
        }

        $categoria->update($request->validated());

        return response()->json([
            'message'  => 'Categoria atualizada com sucesso.',
            'categoria'=> $categoria,
        ]);
    }

    /**
     * DELETE /api/categorias/{id}
     * Remove uma categoria (só se não tiver filmes vinculados).
     */
    public function destroy(int $id): JsonResponse
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoria não encontrada.'], 404);
        }

        if ($categoria->filmes()->count() > 0) {
            return response()->json([
                'message' => 'Não é possível excluir uma categoria com filmes vinculados.',
            ], 422);
        }

        $categoria->delete();

        return response()->json(null, 204);  // 204 No Content
    }
}