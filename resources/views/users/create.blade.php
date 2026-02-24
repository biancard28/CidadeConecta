<h1>Criar Usuário</h1>

<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Nome">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Senha">

    <input type="text" name="tipo" placeholder="Tipo">
    <input type="text" name="categoria" placeholder="Categoria">
    <textarea name="descricao" placeholder="Descrição"></textarea>

    <button type="submit">Salvar</button>
</form>
