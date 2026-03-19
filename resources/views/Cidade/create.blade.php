@extends('layout')

@section('conteudo')
<h1>Cadastrar Cidade</h1>

<div class="card shadow col-md-6 mx-auto border-0">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Cadastrar Cidade</h4>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('cidades.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label text-success fw-bold">Nome</label>
                <input type="text" name="nome" class="form-control border-success @error('nome') is-invalid @enderror" value="{{ old('nome') }}">
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-success fw-bold">UF</label>
                <select name="uf" class="form-select border-success @error('uf') is-invalid @enderror">
                    <option value="">Selecione o estado</option>
                    @php
                        $ufs = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'];
                    @endphp
                    @foreach($ufs as $uf)
                        <option value="{{ $uf }}" {{ old('uf') == $uf ? 'selected' : '' }}>{{ $uf }}</option>
                    @endforeach
                </select>
                @error('uf')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-success fw-bold">CEP</label>
                <input type="text" name="cep" id="cep" class="form-control border-success @error('cep') is-invalid @enderror" value="{{ old('cep') }}">
                @error('cep')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-success">Salvar</button>
            <a href="{{ route('cidades.index') }}" class="btn btn-outline-success">Voltar</a>

        </form>

    </div>
</div>

<script>
    const cepInput = document.getElementById('cep');

    cepInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 5) {
            value = value.slice(0,5) + '-' + value.slice(5,8);
        }
        e.target.value = value;
    });
</script>

@endsection
