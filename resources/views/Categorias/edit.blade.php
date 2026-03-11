@extends('layout')

@section('conteudo')

<div class="card shadow col-md-6 mx-auto border-0 mt-4">
    <div class="card-header bg-warning text-white">
        <h4 class="mb-0">Editar Categoria</h4>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('categorias.update', $categoria) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ $categoria->nome }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <input type="text" name="descricao" class="form-control" value="{{ $categoria->descricao }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <input type="text" name="tipo" class="form-control" value="{{ $categoria->tipo }}">
            </div>

            <button type="submit" class="btn btn-warning text-white">Atualizar</button>
            <a href="{{ route('cidade.show', $categoria->cidade_id) }}" class="btn btn-secondary">Voltar</a>
        </form>

    </div>
</div>

@endsection
