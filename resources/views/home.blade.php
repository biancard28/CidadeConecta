@extends('layouts.visitante')

@section('titulo', 'Cidade Conecta — Encontre sua cidade')

@section('hero')
    <section class="hero">
        <span class="hero__eyebrow">Portal do Cidadão</span>
        <h1 class="hero__title">
            Sua cidade em um<br><em>único lugar</em>
        </h1>
        <p class="hero__subtitle">Encontre informações da sua cidade de forma rápida</p>

        <form action="/buscar" method="GET">
            <div class="search-wrapper">
                <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="cidadeInput" name="q"
                    placeholder="Digite o nome da sua cidade..." autofocus autocomplete="off">
                <div id="autocomplete-list" class="autocomplete-items" style="display:none;"></div>
            </div>
            <button type="submit" class="search-submit">Buscar cidade</button>
        </form>
    </section>
@endsection
