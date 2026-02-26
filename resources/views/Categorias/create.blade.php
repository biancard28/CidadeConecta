@extends('layout')

@section('conteudo')

<h1>Nova Categoria</h1>

<form action="{{ route('categorias.store') }}" method="POST">
@csrf

<p>Nome</p>
<input type="text" name="nome">

<p>Descrição</p>
<input type="text" name="descricao">

<p>Tipo</p>
<input type="text" name="tipo">

<br><br>
<button type="submit">Salvar</button>

</form>

@endsection
