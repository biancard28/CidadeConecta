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

    {{-- Modal --}}
    <div class="modal fade" id="modalAdicionarEvento">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Adicionar Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('eventos.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="cidade_id" value="{{ $categoria->cidade_id }}">

                        <div class="mb-3">
                            <label>Nome *</label>
                            <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Descrição</label>
                            <textarea name="descricao" class="form-control">{{ old('descricao') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Local</label>
                            <input type="text" name="local" class="form-control" value="{{ old('local') }}">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Data *</label>
                                <input type="date" name="data" class="form-control" value="{{ old('data') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Horário</label>
                                <input type="time" name="horario" class="form-control" value="{{ old('horario') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Recorrência</label>
                            <select name="recorrencia" class="form-control">
                                <option value="diaria">Diária</option>
                                <option value="semanal">Semanal</option>
                                <option value="mensal">Mensal</option>
                                <option value="anual">Anual</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Categoria</label>
                            <input type="text" class="form-control" value="{{ $categoria->nome }}" disabled>
                        </div>

                        <button class="btn btn-success w-100">Salvar Evento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Lista de eventos --}}
    <div class="card shadow border-0">
        <div class="card-header bg-info text-white">
            <h5>Eventos desta Categoria</h5>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Local</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categoria->eventos as $evento)
                        <tr>
                            <td>{{ $evento->nome }}</td>
                            <td>{{ \Carbon\Carbon::parse($evento->data)->format('d/m/Y') }}</td>
                            <td>{{ $evento->local }}</td>

                            <td>
                                <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Deseja excluir este evento?')">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Nenhum evento cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- VOLTAR --}}
    <a href="{{ route('cidades.show', $categoria->cidade->id) }}" class="btn btn-outline-success mt-4">
        Voltar para a Cidade
    </a>

</div>
@endsection
