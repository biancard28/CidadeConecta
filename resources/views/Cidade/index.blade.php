@extends('layout')

@section('conteudo')
<h1>Lista de Cidades</h1>

<div class="card shadow border-0">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Cidades</h4>

        @can('create', App\Models\Cidade::class)
            <a href="{{ route('cidades.create') }}" class="btn btn-light btn-sm">+ Nova Cidade</a>
        @endcan
    </div>

    <div class="card-body">

        <table class="table table-hover">
            <thead style="background:#34d399;color:white;">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>UF</th>
                    <th>CEP</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($cidades as $cidade)
                    <tr>
                        <td>{{ $cidade->id }}</td>

                        <td>
                            <a href="{{ route('cidades.show', $cidade->id) }}">
                                {{ $cidade->nome }}
                            </a>
                        </td>

                        <td>{{ $cidade->uf }}</td>
                        <td>{{ $cidade->cep }}</td>

                        <td>
                            @can('create', App\Models\Cidade::class)
                                <a href="{{ route('cidades.edit', $cidade->id) }}" class="btn btn-sm btn-warning">
                                    Editar
                                </a>

                                <form action="{{ route('cidades.destroy', $cidade->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Excluir cidade?')">
                                        Excluir
                                    </button>
                                </form>
                            @endcan
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
