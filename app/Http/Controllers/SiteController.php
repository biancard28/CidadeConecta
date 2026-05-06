<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SiteController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function agenda_municipal(Request $request, Cidade $cidade)
    {
        $categorias = $cidade->categorias;

        $query = $cidade->eventos()
            ->with(['categoria', 'imagens'])
            ->orderBy('data');

        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        if ($request->filled('data_inicio')) {
            $query->whereDate('data', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('data', '<=', $request->data_fim);
        }

        $eventos = $query->get();

        foreach ($eventos as $evento) {
            $imagensFormatadas = [];

            foreach ($evento->imagens as $img) {
                $imagensFormatadas[] = [
                    'url' => asset('storage/' . $img->imagem),
                ];
            }

            $evento->setAttribute(
                'arquivo_url',
                $evento->arquivo
                    ? asset('storage/' . $evento->arquivo)
                    : null
            );

            $evento->setAttribute('imagens_formatadas', $imagensFormatadas);
            $evento->setAttribute(
                'data_formatada',
                Carbon::parse($evento->data)->format('d/m/Y')
            );

            $evento->setAttribute(
                'recorrencia_formatada',
                $evento->recorrencia
                    ? ucfirst($evento->recorrencia)
                    : '-'
            );
        }

        $eventos = $eventos->values();

        $cidades = Cidade::orderBy('nome')->get();

        return view('agenda_municipal', [
            'cidade' => $cidade,
            'categorias' => $categorias,
            'eventos' => $eventos,
            'cidades' => $cidades,
        ]);
    }
}
