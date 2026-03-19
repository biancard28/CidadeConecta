<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import necessário para usar Auth

class CategoriaController extends Controller
{
    /**
     * Lista todas as categorias (não usado, mas deixei por padrão)
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Exibe formulário de criação (não usado, criamos dentro da cidade)
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
        // Autorização opcional: só super admin ou usuários da cidade podem criar
        // $this->authorize('create', Categoria::class);

        Categoria::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'tipo' => $request->tipo,
            'cidade_id' => $request->cidade_id
        ]);

        return back()->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Mostra detalhes da categoria
     */
    public function show($id)
{
    $categoria = \App\Models\Categoria::with('eventos', 'cidade')->findOrFail($id);

    return view('categorias.show', compact('categoria'));
}

    /**
     * Exibe formulário de edição
     */
    public function edit(Categoria $categoria)
    {
        // Chama a policy update antes de permitir editar
        $this->authorize('update', $categoria);

        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Atualiza categoria existente
     */
    public function update(Request $request, Categoria $categoria)
    {
        // Chama a policy update antes de permitir atualizar
        $this->authorize('update', $categoria);

        $categoria->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'tipo' => $request->tipo
        ]);

        return redirect()->route('cidade.show', $categoria->cidade_id)
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Deleta categoria
     */
    public function destroy(Categoria $categoria)
    {
        // Chama a policy delete antes de permitir deletar
        $this->authorize('delete', $categoria);

        $cidade_id = $categoria->cidade_id;
        $categoria->delete();

        return redirect()->route('cidade.show', $cidade_id)
            ->with('success', 'Categoria deletada com sucesso!');
    }
}
