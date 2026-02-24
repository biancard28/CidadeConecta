<h1>Lista de Cidades</h1>

<a href="{{ route('cidade.create') }}">Nova Cidade</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>UF</th>
    <th>CEP</th>
</tr>

@foreach($cidades as $cidade)
<tr>
    <td>{{ $cidade->id }}</td>
    <td>{{ $cidade->nome }}</td>
    <td>{{ $cidade->uf }}</td>
    <td>{{ $cidade->cep }}</td>
</tr>
@endforeach
</table>
