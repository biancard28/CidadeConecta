@extends('layout')

@section('conteudo')

<h1>Prefeitura Municipal - Lista de Categorias de Serviços</h1>

<p>
Gerencie aqui as categorias de serviços oferecidos pela Prefeitura.
Você pode adicionar, editar ou remover categorias conforme necessário.
</p>

<a href="{{ route('categorias.create') }}">
    <button style="background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 5px;">
        Nova Categoria
    </button>
</a>

<br><br>

<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th>ID</th>
            <th>Nome da Categoria</th>
            <th>Descrição</th>
            <th>Tipo de Serviço</th>
            <th>Ações</th>
        </tr>
    </thead>

```
<tbody>
    @foreach($categorias as $categoria)
    <tr>
        <td>{{ $categoria->id }}</td>
        <td>{{ $categoria->nome }}</td>
        <td>{{ $categoria->descricao }}</td>
        <td>{{ $categoria->tipo }}</td>

        <td>

            <a href="{{ route('categorias.show', $categoria->id) }}">
                <button style="background-color: #17a2b8; color: white; padding: 5px 10px; border: none; border-radius: 5px;">
                    Ver Eventos
                </button>
            </a>

            <a href="{{ route('categorias.edit', $categoria->id) }}">
                <button style="background-color: #ffc107; color: black; padding: 5px 10px; border: none; border-radius: 5px;">
                    Editar
                </button>
            </a>

            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')

                <button style="background-color: #dc3545; color: white; padding: 5px 10px; border: none; border-radius: 5px;">
                    Excluir
                </button>
            </form>

        </td>
    </tr>
    @endforeach
</tbody>
```

</table>

@endsection
