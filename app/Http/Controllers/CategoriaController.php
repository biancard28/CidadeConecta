<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

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
        Categoria::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'tipo' => $request->tipo,
            'cidade_id' => $request->cidade_id, // obrigatório para saber a cidade
        ]);

        return redirect()->route('categorias.index');
    }

    /**
     * Mostra detalhes da categoria
     */
    public function show(Categoria $categoria)
    {
        $categoria->load('eventos'); // carrega os eventos
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Exibe formulário de edição
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Atualiza categoria existente
     */
    public function update(Request $request, Categoria $categoria)
    {
        $categoria->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'tipo' => $request->tipo,
            // NÃO precisa atualizar cidade_id aqui
        ]);

        return redirect()->route('categorias.index');
    }

    /**
     * Deleta categoria
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index');
    }
}
