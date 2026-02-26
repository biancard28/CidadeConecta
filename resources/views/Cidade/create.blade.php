@extends('layout')

@section('conteudo')
<h1>Cadastrar Cidade</h1>

<div class="card shadow col-md-6 mx-auto border-0">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Cadastrar Cidade</h4>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('cidade.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label text-success fw-bold">Nome</label>
                <input type="text" name="nome" class="form-control border-success">
            </div>

            <div class="mb-3">
                <label class="form-label text-success fw-bold">UF</label>
                <input type="text" name="uf" class="form-control border-success">
            </div>

            <div class="mb-3">
                <label class="form-label text-success fw-bold">CEP</label>
                <input type="text" name="cep" class="form-control border-success">
            </div>

            <button class="btn btn-success">Salvar</button>
            <a href="{{ route('cidade.index') }}" class="btn btn-outline-success">Voltar</a>

        </form>

    </div>
</div>

@endsection
