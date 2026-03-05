<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Models\Categoria;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('eventos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        Evento::create([
            'user_id' => auth()->id(),
            'categoria_id' => $request->categoria_id,
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'local' => $request->local,
            'data' => $request->data,
            'horario' => $request->horario,
            'recorrencia' => $request->recorrencia,
        ]);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento cadastrado com sucesso!');
    }

    public function edit(Evento $evento)
    {
        return view('eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $evento->update($request->all());
        return redirect()->route('eventos.index');
    }

    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('eventos.index');
    }
}
