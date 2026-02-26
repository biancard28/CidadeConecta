@extends('layout')

@section('conteudo')

<h1>Lista de Categorias</h1>

<a href="{{ route('categorias.create') }}">
    <button>Nova Categoria</button>
</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Tipo</th>

    </tr>

    @foreach($categorias as $categoria)
    <tr>
        <td>{{ $categoria->id }}</td>
        <td>{{ $categoria->nome }}</td>
        <td>{{ $categoria->descricao }}</td>
        <td>{{ $categoria->tipo }}</td>
        <td>
            <a href="{{ route('categorias.edit', $categoria) }}">
                <button>Editar</button>
            </a>

            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button>Excluir</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
