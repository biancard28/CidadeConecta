<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

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
        Categoria::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'tipo' => $request->tipo,
            'cidade_id' => $request->cidade_id
        ]);

        return back();
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
            'tipo' => $request->tipo
        ]);

        return redirect()->route('cidade.show', $categoria->cidade_id);
    }

    /**
     * Deleta categoria
     */
    public function destroy(Categoria $categoria)
    {
        $cidade_id = $categoria->cidade_id;
        $categoria->delete();

        return redirect()->route('cidade.show', $cidade_id);
    }
}
