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
                <select name="uf" class="form-select border-success">
                    <option value="">Selecione o estado</option>

                    <option value="AC" {{ old('uf') == 'AC' ? 'selected' : '' }}>AC</option>
                    <option value="AL" {{ old('uf') == 'AL' ? 'selected' : '' }}>AL</option>
                    <option value="AP" {{ old('uf') == 'AP' ? 'selected' : '' }}>AP</option>
                    <option value="AM" {{ old('uf') == 'AM' ? 'selected' : '' }}>AM</option>
                    <option value="BA" {{ old('uf') == 'BA' ? 'selected' : '' }}>BA</option>
                    <option value="CE" {{ old('uf') == 'CE' ? 'selected' : '' }}>CE</option>
                    <option value="DF" {{ old('uf') == 'DF' ? 'selected' : '' }}>DF</option>
                    <option value="ES" {{ old('uf') == 'ES' ? 'selected' : '' }}>ES</option>
                    <option value="GO" {{ old('uf') == 'GO' ? 'selected' : '' }}>GO</option>
                    <option value="MA" {{ old('uf') == 'MA' ? 'selected' : '' }}>MA</option>
                    <option value="MT" {{ old('uf') == 'MT' ? 'selected' : '' }}>MT</option>
                    <option value="MS" {{ old('uf') == 'MS' ? 'selected' : '' }}>MS</option>
                    <option value="MG" {{ old('uf') == 'MG' ? 'selected' : '' }}>MG</option>
                    <option value="PA" {{ old('uf') == 'PA' ? 'selected' : '' }}>PA</option>
                    <option value="PB" {{ old('uf') == 'PB' ? 'selected' : '' }}>PB</option>
                    <option value="PR" {{ old('uf') == 'PR' ? 'selected' : '' }}>PR</option>
                    <option value="PE" {{ old('uf') == 'PE' ? 'selected' : '' }}>PE</option>
                    <option value="PI" {{ old('uf') == 'PI' ? 'selected' : '' }}>PI</option>
                    <option value="RJ" {{ old('uf') == 'RJ' ? 'selected' : '' }}>RJ</option>
                    <option value="RN" {{ old('uf') == 'RN' ? 'selected' : '' }}>RN</option>
                    <option value="RS" {{ old('uf') == 'RS' ? 'selected' : '' }}>RS</option>
                    <option value="RO" {{ old('uf') == 'RO' ? 'selected' : '' }}>RO</option>
                    <option value="RR" {{ old('uf') == 'RR' ? 'selected' : '' }}>RR</option>
                    <option value="SC" {{ old('uf') == 'SC' ? 'selected' : '' }}>SC</option>
                    <option value="SP" {{ old('uf') == 'SP' ? 'selected' : '' }}>SP</option>
                    <option value="SE" {{ old('uf') == 'SE' ? 'selected' : '' }}>SE</option>
                    <option value="TO" {{ old('uf') == 'TO' ? 'selected' : '' }}>TO</option>

                </select>
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
