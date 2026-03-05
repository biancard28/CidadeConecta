@extends('layout')

@section('conteudo')

<div class="container mt-4">

    <h2>Categoria: {{ $categoria->nome }}</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Descrição:</strong> {{ $categoria->descricao }}</p>
            <p><strong>Tipo:</strong> {{ $categoria->tipo }}</p>
        </div>
    </div>

    <hr>

    <h4>Eventos dessa categoria:</h4>

    @if($categoria->eventos->count())
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Local</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categoria->eventos as $evento)
                    <tr>
                        <td>{{ $evento->nome }}</td>
                        <td>{{ $evento->data }}</td>
                        <td>{{ $evento->horario }}</td>
                        <td>{{ $evento->local }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning mt-3">
            Nenhum evento cadastrado para essa categoria.
        </div>
    @endif

    <a href="{{ route('categorias.index') }}" class="btn btn-secondary mt-3">
        Voltar
    </a>

</div>

@endsection
