<h1>Cadastrar Cidade</h1>

<form method="POST" action="{{ route('cidade.store') }}">
    @csrf

    Nome:
    <input type="text" name="nome"><br><br>

    UF:
    <input type="text" name="uf"><br><br>

    CEP:
    <input type="text" name="cep"><br><br>

    <button type="submit">Salvar</button>
</form>
