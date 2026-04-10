<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CidadeController extends Controller
{
    /**
     * 🔥 AUTOCOMPLETE (CORRIGIDO)
     */
    public function autocomplete(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([]);
        }

        // 👇 AGORA RETORNA ID + NOME
        $cidades = Cidade::where('nome', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(['id', 'nome']);

        return response()->json($cidades);
    }

    /**
     * Painel de cidades
     */
public function index()
{
    $user = Auth::user();

    // Se for admin, pega todas
    if ($user->admin || $user->super_admin) {
        $cidades = Cidade::all();
    } else {
        // Senão, pega só as autorizadas
        $cidades = Cidade::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->get();
    }

    return view('cidade.index', compact('cidades', 'user'));
}

    public function create()
    {
        return view('cidade.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:cidades,nome',
            'uf' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            'cep' => 'required|regex:/^\d{5}-?\d{3}$/',
        ]);

        $cidade = Cidade::create($validated);

        return redirect()->route('cidades.show', $cidade->id);
    }


public function show(Cidade $cidade)
{
    $this->authorize('view', $cidade);

    $usuarios = User::all(); // 👈 AQUI

    return view('cidade.show', compact('cidade', 'usuarios'));
}

    public function addUser(Request $request, Cidade $cidade)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user_id = $request->user_id;

        if (!$cidade->users->contains($user_id)) {
            $cidade->users()->attach($user_id);
        }

        return back()->with('success', 'Usuário adicionado à cidade!');
    }

    public function removeUser($cidade_id, $user_id)
    {
        $cidade = Cidade::findOrFail($cidade_id);
        $user = User::findOrFail($user_id);

        if (Auth::id() == $user_id) {
            return back()->with('error', 'Você não pode se remover da cidade.');
        }

        $cidade->users()->detach($user_id);

        return back()->with('success', 'Usuário removido da cidade.');
    }

    public function edit(Cidade $cidade)
    {
        $this->authorize('update', $cidade);
        return view('cidade.edit', compact('cidade'));
    }

    public function update(Request $request, Cidade $cidade)
    {
        $this->authorize('update', $cidade);

        $request->validate([
            'nome' => 'required',
            'uf' => 'required|max:2',
            'cep' => 'required',
        ]);

        $cidade->update($request->all());

        return redirect()->route('cidades.painel')
            ->with('success', 'Cidade atualizada com sucesso!');
    }

    public function destroy(Cidade $cidade)
    {
        $this->authorize('delete', $cidade);

        $cidade->delete();

        return redirect()->route('cidades.painel')
            ->with('success', 'Cidade deletada com sucesso!');
    }
}
