@extends('layout')

@section('conteudo')

<div class="card shadow col-md-6 mx-auto border-0">
    <div class="card-header bg-warning text-white">
        <h4 class="mb-0">Editar Cidade</h4>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('cidade.update',$cidade->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ $cidade->nome }}">
            </div>

            <div class="mb-3">
                <label class="form-label">UF</label>
                <input type="text" name="uf" class="form-control" value="{{ $cidade->uf }}">
            </div>

            <div class="mb-3">
                <label class="form-label">CEP</label>
                <input type="text" name="cep" class="form-control" value="{{ $cidade->cep }}">
            </div>

            <button class="btn btn-warning text-white">Atualizar</button>
            <a href="{{ route('cidade.index') }}" class="btn btn-secondary">Voltar</a>

        </form>

    </div>
</div>

@endsection
