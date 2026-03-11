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

            {{-- ABAS --}}
            <ul class="nav nav-tabs" id="cidadeTab">

                <li class="nav-item">
                    <button class="nav-link active"
                            data-bs-toggle="tab"
                            data-bs-target="#categorias">
                        Categorias
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#usuarios">
                        Usuários Autorizados
                    </button>
                </li>

            </ul>

            <div class="tab-content mt-3">

                {{-- ABA CATEGORIAS --}}
                <div class="tab-pane fade show active" id="categorias">

                    <h5 class="mb-3">Cadastrar Categoria nesta Cidade</h5>

                    <form method="POST" action="{{ route('categorias.store') }}">
                        @csrf

                        <input type="hidden" name="cidade_id" value="{{ $cidade->id }}">

                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input
                                type="text"
                                name="nome"
                                class="form-control"
                                placeholder="Ex: Cultura, Esporte"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <input
                                type="text"
                                name="descricao"
                                class="form-control"
                                placeholder="Descrição da categoria">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipo</label>
                            <input
                                type="text"
                                name="tipo"
                                class="form-control"
                                placeholder="Tipo da categoria">
                        </div>

                        <button class="btn btn-success">
                            Cadastrar Categoria
                        </button>

                    </form>

                    <hr>

                    <h5 class="mt-4">Categorias desta Cidade</h5>

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Tipo</th>
                                <th width="180">Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($cidade->categorias as $categoria)

                                <tr>

                                    <td>{{ $categoria->nome }}</td>

                                    <td>{{ $categoria->descricao }}</td>

                                    <td>{{ $categoria->tipo }}</td>

                                    <td>

                                        <a href="{{ route('categorias.edit', $categoria->id) }}"
                                           class="btn btn-sm btn-warning">
                                            Editar
                                        </a>

                                        <form action="{{ route('categorias.destroy', $categoria->id) }}"
                                              method="POST"
                                              style="display:inline;">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                                Excluir
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="text-muted">
                                        Nenhuma categoria cadastrada.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- ABA USUARIOS --}}
                <div class="tab-pane fade" id="usuarios">

                    <h5 class="mb-3">Usuários Autorizados</h5>

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                            </tr>
                        </thead>

                        <tbody>

                            @if(isset($cidade->usuarios) && count($cidade->usuarios) > 0)

                                @foreach($cidade->usuarios as $usuario)

                                    <tr>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                    </tr>

                                @endforeach

                            @else

                                <tr>
                                    <td colspan="2" class="text-muted">
                                        Nenhum usuário autorizado.
                                    </td>
                                </tr>

                            @endif

                        </tbody>

                    </table>

                </div>

            </div>

            <a href="{{ route('cidade.index') }}" class="btn btn-outline-success mt-4">
                Voltar
            </a>

        </div>

    </div>

</div>

@endsection
