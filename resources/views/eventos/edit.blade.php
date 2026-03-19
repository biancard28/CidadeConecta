@extends('layout')

@section('conteudo')
<div class="container mt-4">

    <div class="card shadow border-0 col-md-8 mx-auto">

        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Editar Evento</h4>
        </div>

        <div class="card-body">

            {{-- Mensagens --}}
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

                <div class="mb-3">
                    <label class="form-label">Nome do Evento</label>
                    <input type="text" name="nome"
                        class="form-control @error('nome') is-invalid @enderror"
                        value="{{ old('nome', $evento->nome) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="descricao"
                        class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao', $evento->descricao) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Local</label>
                    <input type="text" name="local"
                        class="form-control @error('local') is-invalid @enderror"
                        value="{{ old('local', $evento->local) }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Data</label>
                        <input type="date" name="data"
                            class="form-control @error('data') is-invalid @enderror"
                            value="{{ old('data', $evento->data) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Horário</label>
                        <input type="time" name="horario"
                            class="form-control @error('horario') is-invalid @enderror"
                            value="{{ old('horario', $evento->horario) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Recorrência</label>
                    <select name="recorrencia" class="form-control">
                        <option value="diaria" {{ $evento->recorrencia == 'diaria' ? 'selected' : '' }}>Diária</option>
                        <option value="semanal" {{ $evento->recorrencia == 'semanal' ? 'selected' : '' }}>Semanal</option>
                        <option value="mensal" {{ $evento->recorrencia == 'mensal' ? 'selected' : '' }}>Mensal</option>
                        <option value="anual" {{ $evento->recorrencia == 'anual' ? 'selected' : '' }}>Anual</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        Voltar
                    </a>

                    <button class="btn btn-warning">
                        Atualizar Evento
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
