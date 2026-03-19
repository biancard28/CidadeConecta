@extends('layout')

@section('conteudo')

<div class="container mt-4">

    <div class="card shadow col-md-6 mx-auto border-0">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Editar Cidade</h4>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('cidades.update', $cidade->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" value="{{ old('nome', $cidade->nome) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">UF</label>
                    <input type="text" name="uf" class="form-control" value="{{ old('uf', $cidade->uf) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">CEP</label>
                    <input type="text" name="cep" class="form-control" value="{{ old('cep', $cidade->cep) }}" required>
                </div>

                <button type="submit" class="btn btn-warning text-white">
                    Atualizar Cidade
                </button>

                <a href="{{ route('cidades.show', $cidade->id) }}" class="btn btn-secondary">
                    Cancelar
                </a>

            </form>

        </div>
    </div>

</div>

@endsection
