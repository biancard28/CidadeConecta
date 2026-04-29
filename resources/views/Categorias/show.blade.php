@extends('layout')

@section('conteudo')
    <div class="container mt-4">

        {{-- Mensagens --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Categoria --}}
        <h1>Categoria: {{ $categoria->nome }}</h1>
        <p><strong>Descrição:</strong> {{ $categoria->descricao }}</p>
        <p><strong>Tipo:</strong> {{ $categoria->tipo }}</p>
        <p><strong>Cidade:</strong>
            <a href="{{ route('cidades.show', $categoria->cidade->id) }}">
                {{ $categoria->cidade->nome }}
            </a>
        </p>

        {{-- Botão modal --}}
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAdicionarEvento">
            Adicionar Evento
        </button>

        {{-- MODAL --}}
        <div class="modal fade" id="modalAdicionarEvento">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Adicionar Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        {{-- 🔥 IMPORTANTE: enctype adicionado --}}
                        <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="cidade_id" value="{{ $categoria->cidade_id }}">

                            {{-- NOME --}}
                            <div class="mb-3">
                                <label>Nome *</label>
                                <input type="text" name="nome"
                                    class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}"
                                    required>
                            </div>

                            {{-- DESCRIÇÃO --}}
                            <div class="mb-3">
                                <label>Descrição</label>
                                <textarea name="descricao" class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao') }}</textarea>
                            </div>

                            {{-- LOCAL --}}
                            <div class="mb-3">
                                <label>Local</label>
                                <input type="text" name="local"
                                    class="form-control @error('local') is-invalid @enderror" value="{{ old('local') }}">
                            </div>

                            {{-- 📸 IMAGENS DO EVENTO --}}
                            <div class="mb-3">
                                <label>Imagens do Evento</label>

                                <input type="file" name="imagens[]" class="form-control" multiple accept="image/*">

                                <small class="text-muted">
                                    Você pode selecionar várias imagens.
                                </small>
                            </div>

                            <div class="row">

                                {{-- DATA --}}
                                <div class="col-md-6 mb-3">
                                    <label>Data *</label>
                                    <input type="date" name="data"
                                        class="form-control @error('data') is-invalid @enderror"
                                        value="{{ old('data') }}" required>
                                </div>

                                {{-- DATA FINAL --}}
                                <div class="col-md-6 mb-3">
                                    <label>Data final (opcional)</label>
                                    <input type="date" name="data_fim"
                                        class="form-control @error('data_fim') is-invalid @enderror"
                                        value="{{ old('data_fim') }}">
                                </div>

                                {{-- HORÁRIO --}}
                                <div class="col-md-6 mb-3">
                                    <label>Horário</label>
                                    <input type="time" name="horario"
                                        class="form-control @error('horario') is-invalid @enderror"
                                        value="{{ old('horario') }}">
                                </div>
                            </div>

                            {{-- RECORRÊNCIA --}}
                            <div class="mb-3">
                                <label>Recorrência</label>
                                <select name="recorrencia" id="recorrencia" class="form-control">
                                    <option value="diaria">Diária</option>
                                    <option value="semanal">Semanal</option>
                                    <option value="mensal">Mensal</option>
                                    <option value="anual">Anual</option>
                                </select>
                            </div>

                            {{-- SEMANAL --}}
                            <div id="campo-semanal" class="d-none mb-3">
                                <label>Dias da semana</label><br>

                                @foreach (['domingo', 'segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado'] as $dia)
                                    <label class="me-2">
                                        <input type="checkbox" name="dias_semana[]" value="{{ $dia }}">
                                        {{ ucfirst($dia) }}
                                    </label>
                                @endforeach
                            </div>

                            {{-- MENSAL --}}
                            <div id="campo-mensal" class="d-none mb-3">
                                <label>Dia do mês</label>
                                <input type="number" name="dia_mes" class="form-control" min="1" max="31">
                            </div>

                            {{-- ANUAL --}}
                            <div id="campo-anual" class="d-none mb-3">
                                <label>Data anual</label>
                                <input type="date" name="data_anual" class="form-control">
                            </div>

                            <button class="btn btn-success w-100">
                                Salvar Evento
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- LISTA DE EVENTOS --}}
        <div class="card shadow border-0 mt-4">
            <div class="card-header bg-info text-white">
                <h5>Eventos desta Categoria</h5>
            </div>

            <div class="card-body">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Local</th>
                            <th>Imagens</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categoria->eventos as $evento)
                            <tr>
                                <td>{{ $evento->nome }}</td>
                                <td>{{ \Carbon\Carbon::parse($evento->data)->format('d/m/Y') }}</td>
                                <td>{{ $evento->local }}</td>

                                {{-- 📸 IMAGENS --}}
                                <td>
                                    @if(!empty($evento->imagens) && $evento->imagens->count() > 0)
                                        @foreach($evento->imagens as $img)
                                            <img src="{{ asset('storage/' . $img->imagem) }}"
                                                width="50"
                                                height="50"
                                                class="rounded me-1 border"
                                                style="object-fit: cover;">
                                        @endforeach
                                    @else
                                        <span class="text-muted">Sem imagens</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Deseja excluir este evento?')">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Nenhum evento cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const select = document.getElementById('recorrencia');

            const semanal = document.getElementById('campo-semanal');
            const mensal = document.getElementById('campo-mensal');
            const anual = document.getElementById('campo-anual');

            function atualizarCampos() {
                semanal.classList.add('d-none');
                mensal.classList.add('d-none');
                anual.classList.add('d-none');

                if (select.value === 'semanal') semanal.classList.remove('d-none');
                if (select.value === 'mensal') mensal.classList.remove('d-none');
                if (select.value === 'anual') anual.classList.remove('d-none');
            }

            select.addEventListener('change', atualizarCampos);
            atualizarCampos();
        });
    </script>

@endsection
