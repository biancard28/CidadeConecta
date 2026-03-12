<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\User;
use Illuminate\Http\Request;

class CidadeUsuarioController extends Controller
{
    // Lista usuários autorizados da cidade
    public function index($cidadeId)
    {
        $cidade = Cidade::with('usuariosAutorizados')->findOrFail($cidadeId);

        return view('cidade.usuarios', compact('cidade'));
    }

    // Tela para adicionar usuário autorizado
    public function create($cidadeId)
    {
        $cidade = Cidade::findOrFail($cidadeId);
        $usuarios = User::all();

        return view('cidade.adicionar_usuario', compact('cidade', 'usuarios'));
    }

    // Salvar usuário autorizado
    public function store(Request $request, $cidadeId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $cidade = Cidade::findOrFail($cidadeId);

        $cidade->usuariosAutorizados()->attach($request->user_id);

        return redirect()
            ->route('cidade.show', $cidadeId)
            ->with('success', 'Usuário autorizado com sucesso!');
    }

    // Remover usuário autorizado
    public function destroy($cidadeId, $userId)
    {
        $cidade = Cidade::findOrFail($cidadeId);

        $cidade->usuariosAutorizados()->detach($userId);

        return redirect()
            ->route('cidade.show', $cidadeId)
            ->with('success', 'Usuário removido da cidade.');
    }
}
