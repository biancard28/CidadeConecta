<?php
namespace App\Http\Controllers;   // ⭐ MUITO IMPORTANTE

use App\Models\Cidade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CidadeController extends Controller
{
    public function index()
    {
        $cidades = Cidade::all();
        return view('cidade.index', compact('cidades'));
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
}
