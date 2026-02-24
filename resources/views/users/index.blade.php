<h1>Lista de Usuários</h1>

<a href="{{ route('usuarios.create') }}">Novo Usuário</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1">
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Tipo</th>
        <th>Categoria</th>
        <th>Ações</th>
    </tr>

    @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->tipo }}</td>
            <td>{{ $usuario->categoria }}</td>
            <td>
                <a href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>

                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
