<h1>Criar Evento</h1>

<form action="{{ route('eventos.store') }}" method="POST">
@csrf

<input name="user_id" placeholder="User id">
<input name="nome" placeholder="Nome">
<input name="descricao" placeholder="Descricao">
<input name="local" placeholder="Local">
<input type="date" name="data">
<input type="time" name="horario">

<select name="recorrencia">
<option>diaria</option>
<option>semanal</option>
<option>mensal</option>
<option>anual</option>
</select>

<input name="id_categoria" placeholder="Categoria">

<button>Salvar</button>

</form>
