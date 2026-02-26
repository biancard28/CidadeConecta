<h1>Editar Evento</h1>

<form action="{{ route('eventos.update', $evento) }}" method="POST">
@csrf
@method('PUT')

<input name="nome" value="{{ $evento->nome }}">
<button>Salvar</button>

</form>
