<?php
namespace App\Http\Controllers;   // ⭐ MUITO IMPORTANTE

use App\Models\Cidade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class CidadeController extends Controller
{
public function show($id)
{
    $cidade = Cidade::with(['categorias','usuariosAutorizados'])->findOrFail($id);
    $usuarios = User::all();
    return view('cidade.show', compact('cidade','usuarios'));
}

    public function index()
    {
        $cidades = Cidade::all(); // Pega todas as cidades do banco de dados
        return view('cidade.index', compact('cidades')); // Retorna a view 'cidade.index' passando as cidades para ela
    }

    public function create()
    {
        return view('cidade.create');
    }

    public function store(Request $request)
    {
        Cidade::create($request->all());
        return redirect()->route('cidade.index');
    }


    public function edit($id)
    {
        $cidade = Cidade::findOrFail($id);
        return view('cidade.edit', compact('cidade'));
    }

    public function update(Request $request, $id)
    {
        $cidade = Cidade::findOrFail($id);
        $cidade->update($request->all());
        return redirect()->route('cidade.index');
    }

    public function destroy($id)
    {
        Cidade::destroy($id);
        return redirect()->route('cidade.index');
    }

}

