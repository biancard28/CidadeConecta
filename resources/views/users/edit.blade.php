<h1>Editar Usuário</h1>

<form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $usuario->name }}">
    <input type="email" name="email" value="{{ $usuario->email }}">
    <input type="text" name="tipo" value="{{ $usuario->tipo }}">
    <input type="text" name="categoria" value="{{ $usuario->categoria }}">
    <textarea name="descricao">{{ $usuario->descricao }}</textarea>

    <button type="submit">Atualizar</button>
</form>
