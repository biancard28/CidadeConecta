@extends('layout')

@section('conteudo')

<div class="container mt-4">

    <h1 class="mb-4">Cidade: {{ $cidade->nome }}</h1>

    <div class="card shadow border-0">

        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Informações da Cidade</h5>
        </div>

        <div class="card-body">

            <p><strong>Nome:</strong> {{ $cidade->nome }}</p>
            <p><strong>UF:</strong> {{ $cidade->uf }}</p>
            <p><strong>CEP:</strong> {{ $cidade->cep }}</p>

            <hr>

            <h5 class="mb-3">Categorias desta Cidade</h5>

            {{-- Form para adicionar nova categoria --}}
            <form method="POST" action="{{ route('categorias.store') }}" class="mb-4">
                @csrf
                <input type="hidden" name="cidade_id" value="{{ $cidade->id }}">

                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" name="nome" class="form-control" placeholder="Nome da categoria" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="descricao" class="form-control" placeholder="Descrição">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="tipo" class="form-control" placeholder="Tipo">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-success w-100">Adicionar</button>
                    </div>
                </div>
            </form>

            {{-- Lista de categorias --}}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cidade->categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->nome }}</td>
                            <td>{{ $categoria->descricao }}</td>
                            <td>{{ $categoria->tipo }}</td>
                            <td>
                                <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-warning btn-sm">Editar</a>

                                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted">Nenhuma categoria cadastrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ route('cidade.index') }}" class="btn btn-secondary mt-3">Voltar</a>

        </div>
    </div>
</div>

@endsection
