@extends('layout')

@section('conteudo')
<div class="container mt-4">

    <div class="card shadow border-0 col-md-8 mx-auto">

        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Editar Evento</h4>
        </div>

        <div class="card-body">

            {{-- Mensagens de erro --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('eventos.update', $evento->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nome --}}
                <div class="mb-3">
                    <label class="form-label">Nome do Evento</label>
                    <input type="text" name="nome"
                        class="form-control @error('nome') is-invalid @enderror"
                        value="{{ old('nome', $evento->nome) }}">

                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Descrição --}}
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="descricao"
                        class="form-control @error('descricao') is-invalid @enderror"
                        rows="3">{{ old('descricao', $evento->descricao) }}</textarea>

                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Local --}}
                <div class="mb-3">
                    <label class="form-label">Local</label>
                    <input type="text" name="local"
                        class="form-control @error('local') is-invalid @enderror"
                        value="{{ old('local', $evento->local) }}">

                    @error('local')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Data e Hora --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Data</label>
                        <input type="date" name="data"
                            class="form-control @error('data') is-invalid @enderror"
                            value="{{ old('data', $evento->data) }}">

                        @error('data')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Horário</label>
                        <input type="time" name="horario"
                            class="form-control @error('horario') is-invalid @enderror"
                            value="{{ old('horario', $evento->horario) }}">

                        @error('horario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Recorrência --}}
                <div class="mb-3">
                    <label class="form-label">Recorrência</label>
                    <select name="recorrencia" class="form-control">
                        <option value="">Selecione</option>
                        <option value="diaria" {{ old('recorrencia', $evento->recorrencia) == 'diaria' ? 'selected' : '' }}>Diária</option>
                        <option value="semanal" {{ old('recorrencia', $evento->recorrencia) == 'semanal' ? 'selected' : '' }}>Semanal</option>
                        <option value="mensal" {{ old('recorrencia', $evento->recorrencia) == 'mensal' ? 'selected' : '' }}>Mensal</option>
                        <option value="anual" {{ old('recorrencia', $evento->recorrencia) == 'anual' ? 'selected' : '' }}>Anual</option>
                    </select>
                </div>

                {{-- Categoria --}}
                <div class="mb-3">
                    <label class="form-label">Categoria</label>
                    <select name="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror">
                        <option value="">Selecione uma categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ old('categoria_id', $evento->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>

                    @error('categoria_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Cidade --}}
                <div class="mb-3">
                    <label class="form-label">Cidade</label>
                    <select name="cidade_id" class="form-control @error('cidade_id') is-invalid @enderror">
                        <option value="">Selecione uma cidade</option>
                        @foreach ($cidades as $cidade)
                            <option value="{{ $cidade->id }}"
                                {{ old('cidade_id', $evento->cidade_id) == $cidade->id ? 'selected' : '' }}>
                                {{ $cidade->nome }}
                            </option>
                        @endforeach
                    </select>

                    @error('cidade_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Botões --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        Voltar
                    </a>

                    <button type="submit" class="btn btn-warning">
                        Atualizar Evento
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
