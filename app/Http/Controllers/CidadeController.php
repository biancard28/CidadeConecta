<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CidadeController extends Controller
{
    /**
     * Painel de cidades
     */
    public function index()
    {
        $user = Auth::user();

        // SUPER ADMIN vê tudo
        if ($user->super_admin) {
            $cidades = Cidade::all();

            return view('cidade.index', compact('cidades', 'user'));
        }
        // ADMIN e USUÁRIO vê só cidades permitidas
        else {
            $cidades = $user->cidades;

            return view('cidade.painel', compact('cidades', 'user'));
        }

    }

    public function create()
    {
        return view('cidade.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:cidades,nome',
            'uf' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            'cep' => 'required|regex:/^\d{5}-?\d{3}$/',
        ]);

        $cidade = Cidade::create($validated);

        return redirect()->route('cidades.show', $cidade->id);
    }

    /**
     * Exibe detalhes de uma cidade
     */
    public function show(Cidade $cidade)
    {
        $cidade->load('users', 'categorias', 'eventos');

        // Pega todos os usuários que ainda não estão na cidade
        $usuarios = User::whereDoesntHave('cidades', function ($q) use ($cidade) {
            $q->where('cidade_id', $cidade->id);
        })->get();

        return view('cidade.show', compact('cidade', 'usuarios'));
    }

    /**
     * Adiciona usuário à cidade
     */
    public function addUser(Request $request, Cidade $cidade)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user_id = $request->user_id;

        // Evita duplicidade
        if (!$cidade->users->contains($user_id)) {
            $cidade->users()->attach($user_id);
        }

        return back()->with('success', 'Usuário adicionado à cidade!');
    }

    /**
     * Remove usuário da cidade
     */
    public function removeUser($cidade_id, $user_id)
    {
        $cidade = Cidade::findOrFail($cidade_id);
        $user = User::findOrFail($user_id);

        // Bloqueia se o usuário logado tentar se remover
        if (Auth::id() == $user_id) {
            return back()->with('error', 'Você não pode se remover da cidade.');
        }

        // Remove usuário normalmente
        $cidade->users()->detach($user_id);

        return back()->with('success', 'Usuário removido da cidade.');
    }

    /**
     * Edita cidade (apenas admins autorizados)
     */
    public function edit(Cidade $cidade)
    {
        $this->authorize('update', $cidade);
        return view('cidade.edit', compact('cidade'));
    }

    /**
     * Atualiza cidade
     */
    public function update(Request $request, Cidade $cidade)
    {
        $this->authorize('update', $cidade);

        $request->validate([
            'nome' => 'required',
            'uf' => 'required|max:2',
            'cep' => 'required',
        ]);

        $cidade->update($request->all());

        return redirect()->route('cidade.painel')
            ->with('success', 'Cidade atualizada com sucesso!');
    }

    /**
     * Deleta cidade
     */
    public function destroy(Cidade $cidade)
    {
        $this->authorize('delete', $cidade);

        $cidade->delete();

        return redirect()->route('cidade.painel')
            ->with('success', 'Cidade deletada com sucesso!');
    }
}
