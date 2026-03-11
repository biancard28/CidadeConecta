@extends('layout')

@section('conteudo')

<div class="container mt-4">

    <h1 class="mb-4">Editar Categoria</h1>

    <div class="card shadow border-0">

        <div class="card-body">

            <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input
                        type="text"
                        name="nome"
                        class="form-control"
                        value="{{ $categoria->nome }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <input
                        type="text"
                        name="descricao"
                        class="form-control"
                        value="{{ $categoria->descricao }}"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo</label>
                    <input
                        type="text"
                        name="tipo"
                        class="form-control"
                        value="{{ $categoria->tipo }}"
                    >
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        Atualizar
                    </button>

                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
