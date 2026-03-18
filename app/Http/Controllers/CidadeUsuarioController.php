<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CidadeUsuarioController extends Controller
{
    // Tela para adicionar usuário autorizado
    public function create($cidadeId)
    {
        $cidade = Cidade::findOrFail($cidadeId);
        $usuarios = User::all(); // ou filtrar usuários que não estão na cidade

        return view('cidade.adicionar_usuario', compact('cidade', 'usuarios'));
    }

    // Salvar usuário autorizado
    public function store(Request $request, $cidadeId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $cidade = Cidade::findOrFail($cidadeId);
        $userId = $request->user_id;

        // Verifica se já está na cidade
        if ($cidade->users->contains($userId)) {
            return redirect()
                ->to(route('cidade.show', $cidadeId) . '#usuarios')
                ->with('error', 'Este usuário já está autorizado para esta cidade.');
        }

        // Adiciona usuário
        $cidade->users()->attach($userId);

        return redirect()
            ->to(route('cidade.show', $cidadeId) . '#usuarios')
            ->with('success', 'Usuário autorizado com sucesso!');
    }

    // Remover usuário autorizado
    public function destroy($cidadeId, $userId)
    {
        $cidade = Cidade::findOrFail($cidadeId);

        // Bloqueia remoção do próprio usuário
        if (Auth::id() == $userId) {
            return redirect()
                ->to(route('cidade.show', $cidadeId) . '#usuarios')
                ->with('error', 'Você não pode se remover da cidade.');
        }

        $cidade->users()->detach($userId);

        return redirect()
            ->to(route('cidade.show', $cidadeId) . '#usuarios')
            ->with('success', 'Usuário removido da cidade.');
    }
}
