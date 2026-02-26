@extends('layout')

@section('conteudo')

<h1>Editar Categoria</h1>

<form action="{{ route('categorias.update', $categoria) }}" method="POST">
@csrf
@method('PUT')

<p>Nome</p>
<input type="text" name="nome" value="{{ $categoria->nome }}">

<p>Descrição</p>
<input type="text" name="descricao" value="{{ $categoria->descricao }}">

<p>Tipo</p>
<input type="text" name="tipo" value="{{ $categoria->tipo }}">

<br><br>
<button type="submit">Atualizar</button>

</form>

@endsection
