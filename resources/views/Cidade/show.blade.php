@extends('layout')

@section('conteudo')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="container mt-4">

    {{-- AVISOS DO SISTEMA --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
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

            {{-- ABAS --}}
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

                {{-- ABA CATEGORIAS --}}
                <div class="tab-pane fade show active" id="categorias">

                    <h5 class="mb-3">Categorias desta Cidade</h5>

                    <form method="POST" action="{{ route('categorias.store') }}" class="mb-4">
                        @csrf
                        <input type="hidden" name="cidade_id" value="{{ $cidade->id }}">

                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="nome" class="form-control"
                                    placeholder="Nome da categoria" required>
                            </div>

                            <div class="col-md-4">
                                <input type="text" name="descricao" class="form-control" placeholder="Descrição">
                            </div>

                            <div class="col-md-3">
                                <input type="text" name="tipo" class="form-control" placeholder="Tipo">
                            </div>

                            <div class="col-md-1">
                                <button class="btn btn-success w-100">
                                    Adicionar
                                </button>
                            </div>
                        </div>
                    </form>

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
                                    <td>
                                        <a href="{{ route('categorias.show', $categoria->id) }}" class="link-primary">
                                            {{ $categoria->nome }}
                                        </a>
                                    </td>
                                    <td>{{ $categoria->descricao }}</td>
                                    <td>{{ $categoria->tipo }}</td>
                                    <td>
                                        <a href="{{ route('categorias.edit', $categoria) }}"
                                            class="btn btn-warning btn-sm">
                                            Editar
                                        </a>

                                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
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

                    <h5 class="mb-3">Adicionar Usuário Autorizado</h5>

                    <form method="POST" action="{{ route('cidade.usuarios.store', $cidade->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Selecionar Usuário</label>
                            <select name="user_id" class="form-control select-usuario" required>
                                <option value="">Pesquisar usuário...</option>
                                @foreach ($usuarios as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success">Adicionar Usuário</button>
                    </form>

                    <hr>

                    <h5 class="mb-3">Usuários Autorizados</h5>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th width="120">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cidade->users as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>
                                        @if(Auth::id() != $usuario->id)
                                            <form method="POST"
                                                action="{{ route('cidade.usuarios.destroy', [$cidade->id, $usuario->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Remover usuário desta cidade?')">
                                                    Remover
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">Você</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">Nenhum usuário autorizado.</td>
                                </tr>
                            @endforelse
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select-usuario').select2({
            placeholder: "Pesquisar usuário por nome ou email",
            width: '100%'
        });

        if (window.location.hash === "#usuarios") {
            let trigger = document.querySelector('#tab-usuarios');
            let tab = new bootstrap.Tab(trigger);
            tab.show();
        }

        $('#tab-usuarios').click(function() {
            history.replaceState(null, null, "#usuarios");
        });

        $('#tab-categorias').click(function() {
            history.replaceState(null, null, "#categorias");
        });
    });
</script>
@endsection
