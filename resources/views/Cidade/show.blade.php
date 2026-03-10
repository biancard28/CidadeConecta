@extends('layout')

@section('conteudo')

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
        <ul class="nav nav-tabs" id="cidadeTab" role="tablist">

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

                <h5>Adicionar Categoria</h5>

                <form method="POST" action="{{ route('categorias.store') }}">
                    @csrf

                    <input type="hidden" name="cidade_id" value="{{ $cidade->id }}">

                    <div class="input-group mb-3">
                        <input type="text" name="nome" class="form-control" placeholder="Nome da categoria">

                        <button class="btn btn-success">
                            Adicionar
                        </button>
                    </div>
                </form>

                <h5>Lista de Categorias</h5>

                <ul class="list-group">

                    @foreach($cidade->categorias as $categoria)

                        <li class="list-group-item d-flex justify-content-between">

                            {{ $categoria->nome }}

                        </li>

                    @endforeach

                </ul>

            </div>


            {{-- ABA USUARIOS --}}
            <div class="tab-pane fade" id="usuarios">

                <h5>Usuários Autorizados</h5>

                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>

                        {{-- @foreach($cidade->usuarios as $usuario)

                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                        </tr>

                        @endforeach --}}

                    </tbody>

                </table>

            </div>

        </div>

        <a href="{{ route('cidade.index') }}" class="btn btn-outline-success mt-3">
            Voltar
        </a>

    </div>
</div>

@endsection
