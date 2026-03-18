@extends('layout')

@section('conteudo')
<h1>Painel de Cidades</h1>

{{-- Mensagem se o usuário não for admin --}}
@if(!$user->admin && !$user->super_admin)
    {{-- Overlay preto cobrindo a tela --}}
    <div class="overlay">
        <div class="alert-box text-center">
            <div class="alert alert-warning">
                ⚠️ Somente administradores podem acessar o painel de cidades.
            </div>
            <a href="{{ route('home') }}" class="btn btn-success mt-3">
                Voltar para Home
            </a>
        </div>
    </div>
@endif

<div class="row">
    {{-- Apenas mostra os cards se for admin ou super admin --}}
    @if($user->admin || $user->super_admin)
        @forelse($cidades as $cidade)
            <div class="col-md-4 mb-4">
                <a href="{{ route('cidade.show', $cidade->id) }}" style="text-decoration: none;">
                    <div class="card shadow-sm h-100" style="transition: transform 0.2s;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $cidade->nome }}</h5>
                            <p class="card-text">
                                UF: {{ $cidade->uf }} <br>
                                CEP: {{ $cidade->cep }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">Nenhuma cidade cadastrada.</p>
            </div>
        @endforelse
    @endif
</div>

<style>
.card:hover {
    transform: scale(1.05);
}

/* Overlay preto */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.85); /* preto semi-transparente */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* acima de tudo */
}

/* Caixa de alerta centralizada */
.alert-box {
    width: 90%;
    max-width: 500px;
    background: #fff; /* fundo branco para a mensagem */
    padding: 30px 20px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}
</style>
@endsection
