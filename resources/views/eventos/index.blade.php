<h1>Eventos</h1>

<a href="{{ route('eventos.create') }}">Novo Evento</a>

@foreach($eventos as $evento)
    <p>{{ $evento->nome }}</p>

    <a href="{{ route('eventos.edit', $evento) }}">Editar</a>

    <form action="{{ route('eventos.destroy', $evento) }}" method="POST">
        @csrf
        @method('DELETE')
        <button>Excluir</button>
    </form>
@endforeach
