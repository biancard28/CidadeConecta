<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * Lista todos os eventos
     */
    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    /**
     * Exibe formulário de criação
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('eventos.create', compact('categorias'));
    }

    /**
     * Salva novo evento
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'cidade_id' => 'required|exists:cidades,id' // Necessário para a policy
        ]);

        $evento = Evento::create([
            'user_id' => Auth::id(),
            'categoria_id' => $request->categoria_id,
            'cidade_id' => $request->cidade_id, // Importante para a policy
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'local' => $request->local,
            'data' => $request->data,
            'horario' => $request->horario,
            'recorrencia' => $request->recorrencia,
        ]);

        return redirect()->route('categoria.show' , $evento->categoria_id)
            ->with('success', 'Evento cadastrado com sucesso!');
    }

    /**
     * Exibe formulário de edição
     */
    public function edit(Evento $evento)
    {
        // Chama a policy antes de permitir editar
        $this->authorize('update', $evento);

        return view('eventos.edit', compact('evento'));
    }

    /**
     * Atualiza evento existente
     */
    public function update(Request $request, Evento $evento)
    {
        // Chama a policy antes de permitir atualizar
        $this->authorize('update', $evento);

        $request->validate([
            'nome' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'cidade_id' => 'required|exists:cidades,id'
        ]);

        $evento->update([
            'nome' => $request->nome,
            'categoria_id' => $request->categoria_id,
            'cidade_id' => $request->cidade_id,
            'descricao' => $request->descricao,
            'local' => $request->local,
            'data' => $request->data,
            'horario' => $request->horario,
            'recorrencia' => $request->recorrencia,
        ]);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento atualizado com sucesso!');
    }

    /**
     * Deleta evento
     */
    public function destroy(Evento $evento)
    {
        // Chama a policy antes de permitir deletar
        $this->authorize('delete', $evento);

        $evento->delete();

        return redirect()->route('eventos.index')
            ->with('success', 'Evento deletado com sucesso!');
    }
}
