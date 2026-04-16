<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Evento;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // HOME
    public function home()
    {
        return view('home');
    }

    // AGENDA DA CIDADE
    public function agenda_municipal(Request $request, Cidade $cidade)
    {
        // pega categorias da cidade
        $categorias = $cidade->categorias;
{
    $categorias = $cidade->categorias;

    $eventos = $cidade->eventos()
        ->with('categoria')
        ->orderBy('data')
        ->get();

    // 🔥 ESSA LINHA QUE FALTA
    $cidades = Cidade::all();

    return view('agenda_municipal', [
        'cidade' => $cidade,
        'categorias' => $categorias,
        'eventos' => $eventos,
        'cidades' => $cidades, // 🔥 ESSENCIAL
    ]);
}

        // FILTRO POR CATEGORIA
        if ($request->has('categoria') && $request->categoria != '') {
            $eventos = Evento::where('categoria_id', $request->categoria)
                ->orderBy('data')
                ->get();
        } else {
            // todos eventos da cidade
            $eventos = $cidade->eventos()->orderBy('data')->get();
        }

        return view('agenda_municipal', compact('cidade', 'categorias', 'eventos'));
    }

}
