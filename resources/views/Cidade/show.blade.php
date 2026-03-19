@extends('layout')

@section('conteudo')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="container mt-4">

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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

            <ul class="nav nav-tabs" id="cidadeTab">

                <li class="nav-item">
                    <button id="tab-categorias" class="nav-link active" data-bs-toggle="tab"
                        data-bs-target="#categorias">
                        Categorias
                    </button>
                </li>

                <li class="nav-item">
                    <button id="tab-usuarios" class="nav-link" data-bs-toggle="tab" data-bs-target="#usuarios">
                        Usuários Autorizados
                    </button>
                </li>

            </ul>

            <div class="tab-content mt-3">

                {{-- CATEGORIAS --}}
                <div class="tab-pane fade show active" id="categorias">

                    <h5 class="mb-3">Categorias desta Cidade</h5>

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

                    <table class="table table-striped">
                        <tbody>
                            @forelse($cidade->categorias as $categoria)
                                <tr>
                                    <td>
                                        <a href="{{ route('categorias.show', $categoria->id) }}">
                                            {{ $categoria->nome }}
                                        </a>
                                    </td>

                                    <td>{{ $categoria->descricao }}</td>
                                    <td>{{ $categoria->tipo }}</td>

                                    <td>
                                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm">
                                            Editar
                                        </a>

                                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Nenhuma categoria cadastrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                {{-- USUÁRIOS --}}
                <div class="tab-pane fade" id="usuarios">

                    <h5>Adicionar Usuário</h5>

                    <form method="POST" action="{{ route('cidades.usuarios.store', $cidade->id) }}">
                        @csrf

                        <select name="user_id" class="form-control select-usuario" required>
                            <option value="">Selecionar usuário</option>
                            @foreach ($usuarios as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>

                        <button class="btn btn-success mt-2">Adicionar</button>
                    </form>

                    <hr>

                    <table class="table">
                        <tbody>
                            @forelse($cidade->users as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>

                                    <td>
                                        @if(Auth::id() != $usuario->id)
                                            <form method="POST"
                                                action="{{ route('cidades.usuarios.destroy', [$cidade->id, $usuario->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">Remover</button>
                                            </form>
                                        @else
                                            Você
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Nenhum usuário</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>

            {{-- VOLTAR --}}
            <a href="{{ route('cidades.index') }}" class="btn btn-outline-success mt-4">
                Voltar
            </a>

        </div>
    </div>

</div>
@endsection
