<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::with('imagens')->get();
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('eventos.create', compact('categorias'));
    }

    /**
     * 💾 SALVAR EVENTO COM RECORRÊNCIA + IMAGENS
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'cidade_id' => 'required|exists:cidades,id',
            'data' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data',
            'recorrencia' => 'required',
            'imagens' => 'nullable|array',
            'imagens.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $dataBase = Carbon::parse($request->data);
        $dataFim = $request->data_fim ? Carbon::parse($request->data_fim) : null;

        $datas = [];

        // DIÁRIA
        if ($request->recorrencia === 'diaria') {
            $limite = $dataFim ?? $dataBase->copy()->addDays(30);

            for ($date = $dataBase->copy(); $date <= $limite; $date->addDay()) {
                $datas[] = $date->copy();
            }
        }

        // SEMANAL
        elseif ($request->recorrencia === 'semanal') {

            $diasSemana = $request->dias_semana ?? [];

            $map = [
                'sunday' => 'domingo',
                'monday' => 'segunda',
                'tuesday' => 'terca',
                'wednesday' => 'quarta',
                'thursday' => 'quinta',
                'friday' => 'sexta',
                'saturday' => 'sabado',
            ];

            $limite = $dataFim ?? $dataBase->copy()->addWeeks(12);

            for ($date = $dataBase->copy(); $date <= $limite; $date->addDay()) {

                $diaSemana = strtolower($date->format('l'));

                if (empty($diasSemana)) {
                    if ($date->diffInWeeks($dataBase) <= 12) {
                        $datas[] = $date->copy();
                    }
                } else {
                    if (isset($map[$diaSemana]) && in_array($map[$diaSemana], $diasSemana)) {
                        $datas[] = $date->copy();
                    }
                }
            }
        }

        // MENSAL
        elseif ($request->recorrencia === 'mensal') {
            $limite = $dataFim ?? $dataBase->copy()->addMonths(12);

            for ($date = $dataBase->copy(); $date <= $limite; $date->addMonth()) {
                $datas[] = $date->copy();
            }
        }

        // ANUAL
        elseif ($request->recorrencia === 'anual') {
            $limite = $dataFim ?? $dataBase->copy()->addYears(5);

            for ($date = $dataBase->copy(); $date <= $limite; $date->addYear()) {
                $datas[] = $date->copy();
            }
        }

        // SEM RECORRÊNCIA
        else {
            $datas[] = $dataBase;
        }

        // 📸 SALVAR IMAGENS
        $imagensSalvas = [];

        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $file) {
                $imagensSalvas[] = $file->store('eventos', 'public');
            }
        }

        // 💾 CRIAR EVENTOS
        foreach ($datas as $data) {

            $evento = Evento::create([
                'user_id' => Auth::id(),
                'categoria_id' => $request->categoria_id,
                'cidade_id' => $request->cidade_id,
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'local' => $request->local,
                'data' => $data->format('Y-m-d'),
                'data_fim' => $request->data_fim,
                'horario' => $request->horario,
                'recorrencia' => $request->recorrencia,
            ]);

            foreach ($imagensSalvas as $path) {
                $evento->imagens()->create([
                    'imagem' => $path
                ]);
            }
        }

        return redirect()
            ->route('categorias.show', $request->categoria_id)
            ->with('success', 'Evento(s) criado(s) com sucesso!');
    }

    public function edit(Evento $evento)
    {
        $this->authorize('update', $evento);

        $categorias = Categoria::all();
        $cidades = \App\Models\Cidade::all();

        return view('eventos.edit', compact('evento', 'categorias', 'cidades'));
    }

    public function update(Request $request, Evento $evento)
    {
        $this->authorize('update', $evento);

        $request->validate([
            'nome' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'cidade_id' => 'required|exists:cidades,id',
            'data_fim' => 'nullable|date|after_or_equal:data',
        ]);

        $evento->update([
            'nome' => $request->nome,
            'categoria_id' => $request->categoria_id,
            'cidade_id' => $request->cidade_id,
            'descricao' => $request->descricao,
            'local' => $request->local,
            'data' => $request->data,
            'data_fim' => $request->data_fim,
            'horario' => $request->horario,
            'recorrencia' => $request->recorrencia,
        ]);

        return redirect()
            ->route('categorias.show', $evento->categoria_id)
            ->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy(Evento $evento)
    {
        $categoria = $evento->categoria;

        $this->authorize('delete', $evento);

        $evento->delete();

        return redirect()
            ->route('categorias.show', $categoria->id)
            ->with('success', 'Evento deletado com sucesso!');
    }

    /**
     * 🗑️ EXCLUIR SELECIONADOS (MASSA)
     */
    public function deleteSelecionados(Request $request)
    {
        $request->validate([
            'eventos' => 'required|array'
        ]);

        $eventos = Evento::with('imagens')
            ->whereIn('id', $request->eventos)
            ->get();

        foreach ($eventos as $evento) {

            foreach ($evento->imagens as $img) {
                Storage::disk('public')->delete($img->imagem);
                $img->delete();
            }

            $evento->delete();
        }

        return back()->with('success', 'Eventos selecionados excluídos com sucesso!');
    }
}
