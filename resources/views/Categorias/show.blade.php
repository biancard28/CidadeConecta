@extends('layout')

@section('conteudo')
<div class="container mt-4">

    {{-- Mensagens de sucesso ou erro --}}
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

    {{-- Informações da Categoria --}}
    <h1>Categoria: {{ $categoria->nome }}</h1>
    <p><strong>Descrição:</strong> {{ $categoria->descricao }}</p>
    <p><strong>Tipo:</strong> {{ $categoria->tipo }}</p>
    <p><strong>Cidade:</strong>
        <a href="{{ route('cidade.show', $categoria->cidade->id) }}">{{ $categoria->cidade->nome }}</a>
    </p>

    {{-- Botão para abrir o modal --}}
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAdicionarEvento">
        Adicionar Evento
    </button>

    {{-- Modal Bootstrap 5 --}}
    <div class="modal fade" id="modalAdicionarEvento" tabindex="-1" aria-labelledby="modalAdicionarEventoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalAdicionarEventoLabel">Adicionar Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('eventos.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <div class="mb-3">
                            <label class="form-label">Nome do Evento <span class="text-danger">*</span></label>
                            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                                   placeholder="Nome" value="{{ old('nome') }}" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea name="descricao" class="form-control @error('descricao') is-invalid @enderror"
                                      placeholder="Descrição">{{ old('descricao') }}</textarea>
                            @error('descricao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Local</label>
                            <input type="text" name="local" class="form-control @error('local') is-invalid @enderror"
                                   placeholder="Local" value="{{ old('local') }}">
                            @error('local')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Data <span class="text-danger">*</span></label>
                                <input type="date" name="data" class="form-control @error('data') is-invalid @enderror"
                                       value="{{ old('data') }}" required>
                                @error('data')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Horário</label>
                                <input type="time" name="horario" class="form-control @error('horario') is-invalid @enderror"
                                       value="{{ old('horario') }}">
                                @error('horario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Recorrência</label>
                            <select name="recorrencia" class="form-control @error('recorrencia') is-invalid @enderror">
                                <option value="diaria" {{ old('recorrencia') == 'diaria' ? 'selected' : '' }}>Diária</option>
                                <option value="semanal" {{ old('recorrencia') == 'semanal' ? 'selected' : '' }}>Semanal</option>
                                <option value="mensal" {{ old('recorrencia') == 'mensal' ? 'selected' : '' }}>Mensal</option>
                                <option value="anual" {{ old('recorrencia') == 'anual' ? 'selected' : '' }}>Anual</option>
                            </select>
                            @error('recorrencia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Categoria já preenchida --}}
                        <div class="mb-3">
                            <label class="form-label">Categoria</label>
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
                                <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este evento?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted">Nenhum evento cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('cidade.show', $categoria->cidade->id) }}" class="btn btn-outline-success mt-4">Voltar para a Cidade</a>

</div>
@endsection
