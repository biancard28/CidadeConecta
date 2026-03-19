<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    /**
     * Lista todas as categorias
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Exibe formulário de criação
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Salva nova categoria
     */
    public function store(Request $request)
    {
        // Validação
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'tipo' => 'nullable|string|max:50',
            'cidade_id' => 'required|exists:cidades,id',
        ]);

        $categoria = Categoria::create($validated);

        return redirect()->route('categorias.show', $categoria->id)
            ->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Mostra detalhes da categoria
     */
    public function show(Categoria $categoria)
    {
        $categoria->load('eventos', 'cidade');
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Exibe formulário de edição
     */
    public function edit(Categoria $categoria)
    {
        $this->authorize('update', $categoria);
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Atualiza categoria existente
     */
    public function update(Request $request, Categoria $categoria)
    {
        $this->authorize('update', $categoria);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'tipo' => 'nullable|string|max:50',
        ]);

        $categoria->update($validated);

        return redirect()->route('cidades.show', $categoria->cidade_id)
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Deleta categoria
     */
    public function destroy(Categoria $categoria)
    {
        $this->authorize('delete', $categoria);

        $cidade_id = $categoria->cidade_id;
        $categoria->delete();

        return redirect()->route('cidades.show', $cidade_id)
            ->with('success', 'Categoria deletada com sucesso!');
    }
}
