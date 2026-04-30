@extends('layout')

@section('conteudo')
<div class="container mt-4">

    {{-- Mensagens --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Categoria --}}
    <h1>Categoria: {{ $categoria->nome }}</h1>
    <p><strong>Descrição:</strong> {{ $categoria->descricao }}</p>
    <p><strong>Tipo:</strong> {{ $categoria->tipo }}</p>

    <p><strong>Cidade:</strong>
        <a href="{{ route('cidades.show', $categoria->cidade->id) }}">
            {{ $categoria->cidade->nome }}
        </a>
    </p>

    {{-- Botão modal --}}
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAdicionarEvento">
        Adicionar Evento
    </button>

    {{-- MODAL --}}
    <div class="modal fade" id="modalAdicionarEvento">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Adicionar Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="cidade_id" value="{{ $categoria->cidade_id }}">

                        <div class="mb-3">
                            <label>Nome *</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Descrição</label>
                            <textarea name="descricao" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Local</label>
                            <input type="text" name="local" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Imagens</label>
                            <input type="file" name="imagens[]" class="form-control" multiple>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Data *</label>
                                <input type="date" name="data" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Data final</label>
                                <input type="date" name="data_fim" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Horário</label>
                                <input type="time" name="horario" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Recorrência</label>
                            <select name="recorrencia" id="recorrencia" class="form-control">
                                <option value="diaria">Diária</option>
                                <option value="semanal">Semanal</option>
                                <option value="mensal">Mensal</option>
                                <option value="anual">Anual</option>
                            </select>
                        </div>

                        <div id="campo-semanal" class="d-none mb-3">
                            @foreach (['domingo','segunda','terca','quarta','quinta','sexta','sabado'] as $dia)
                                <label class="me-2">
                                    <input type="checkbox" name="dias_semana[]" value="{{ $dia }}">
                                    {{ ucfirst($dia) }}
                                </label>
                            @endforeach
                        </div>

                        <div id="campo-mensal" class="d-none mb-3">
                            <input type="number" name="dia_mes" class="form-control" placeholder="Dia do mês">
                        </div>

                        <div id="campo-anual" class="d-none mb-3">
                            <input type="date" name="data_anual" class="form-control">
                        </div>

                        <button class="btn btn-success w-100">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM EXCLUIR EM MASSA --}}
    <form id="formDeleteSelecionados"
          action="{{ route('eventos.deleteSelecionados') }}"
          method="POST">

        @csrf
        @method('DELETE')

        <button type="submit"
        id="btnExcluirSelecionados"
        class="btn btn-danger mb-2"
        onclick="return confirm('Excluir selecionados?')">
    Excluir Selecionados
</button>

        {{-- LISTA --}}
        <div class="card shadow">

            <div class="card-header bg-info text-white">
                Eventos
            </div>

            <div class="card-body">

                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="checkAll">
                            </th>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Local</th>
                            <th>Imagens</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categoria->eventos as $evento)
                        <tr>
                            <td>
                                <input type="checkbox"
                                       name="eventos[]"
                                       value="{{ $evento->id }}"
                                       class="checkItem">
                            </td>

                            <td>{{ $evento->nome }}</td>
                            <td>{{ \Carbon\Carbon::parse($evento->data)->format('d/m/Y') }}</td>
                            <td>{{ $evento->local }}</td>

                            <td>
                                @if($evento->imagens && $evento->imagens->count())
                                    @foreach($evento->imagens as $img)
                                        <img src="{{ asset('storage/'.$img->imagem) }}" width="50">
                                    @endforeach
                                @else
                                    Sem imagens
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('eventos.edit',$evento->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <form action="{{ route('eventos.destroy',$evento->id) }}"
                                      method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Excluir?')">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Nenhum evento</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>

    </form>

</div>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function(){

    // RECORRÊNCIA
    const select = document.getElementById('recorrencia');
    const semanal = document.getElementById('campo-semanal');
    const mensal = document.getElementById('campo-mensal');
    const anual = document.getElementById('campo-anual');

    function atualizar(){
        semanal.classList.add('d-none');
        mensal.classList.add('d-none');
        anual.classList.add('d-none');

        if(select.value === 'semanal') semanal.classList.remove('d-none');
        if(select.value === 'mensal') mensal.classList.remove('d-none');
        if(select.value === 'anual') anual.classList.remove('d-none');
    }

    select.addEventListener('change', atualizar);
    atualizar();

    // CHECK ALL
    const checkAll = document.getElementById('checkAll');
    const items = document.querySelectorAll('.checkItem');

    checkAll.addEventListener('change', function(){
        items.forEach(i => i.checked = this.checked);
    });

    // EXCLUSÃO SEGURA
    document.getElementById('btnExcluirSelecionados').addEventListener('click', function () {

        const selecionados = document.querySelectorAll('.checkItem:checked');

        if (selecionados.length === 0) {
            alert('Selecione pelo menos um evento');
            return;
        }

        if (!confirm('Deseja excluir os selecionados?')) return;

        document.getElementById('formDeleteSelecionados').submit();
    });

});
</script>

@endsection
