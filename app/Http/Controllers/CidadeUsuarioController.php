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

        // Verifica se já existe
        $existe = $cidade->usuariosAutorizados()
            ->where('users.id', $request->user_id)
            ->exists();

        if ($existe) {
            return redirect()
                ->to(route('cidade.show', $cidadeId) . '#usuarios')
                ->with('error', 'Este usuário já está autorizado para esta cidade.');
        }

        // Se não existir, adiciona
        $cidade->usuariosAutorizados()->attach($request->user_id);

        return redirect()
            ->to(route('cidade.show', $cidadeId) . '#usuarios')
            ->with('success', 'Usuário autorizado com sucesso!');
    }

    // Remover usuário autorizado
    public function destroy($cidadeId, $userId)
    {
        $cidade = Cidade::findOrFail($cidadeId);

        $cidade->usuariosAutorizados()->detach($userId);

        return redirect()
            ->to(route('cidade.show', $cidadeId) . '#usuarios')
            ->with('success', 'Usuário removido da cidade.');
    }
}
