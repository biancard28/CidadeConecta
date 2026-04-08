@extends('layouts.visitante')

@section('titulo', $cidade->nome . ' — Agenda Municipal')

@section('conteudo')

{{-- CABEÇALHO DA PÁGINA --}}
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:28px; flex-wrap:wrap; gap:12px;">

    <div>
        <span style="
            display:inline-block;
            font-size:11px;
            font-weight:600;
            letter-spacing:2px;
            text-transform:uppercase;
            color:var(--verde);
            background:var(--verde-xlight);
            padding:4px 12px;
            border-radius:50px;
            margin-bottom:8px;
        ">Agenda Municipal</span>
        <h2 style="font-family:'Sora',sans-serif; font-size:26px; font-weight:700; letter-spacing:-0.5px; color:var(--texto); margin:0;">
            Agenda da Cidade
        </h2>
    </div>

    {{-- DROPDOWN CIDADE --}}
    <div style="position:relative;" id="cidadeDropdownWrapper">
        <button onclick="toggleDropdown()" style="
            display:flex;
            align-items:center;
            gap:8px;
            background:var(--verde);
            color:#fff;
            border:none;
            padding:10px 18px;
            border-radius:50px;
            font-family:'Sora',sans-serif;
            font-size:14px;
            font-weight:600;
            cursor:pointer;
            transition:background 0.2s;
        " onmouseover="this.style.background='var(--verde-light)'"
           onmouseout="this.style.background='var(--verde)'">
            📍 {{ $cidade->nome }}
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </button>

        <div id="cidadeDropdown" style="
            display:none;
            position:absolute;
            right:0;
            top:calc(100% + 6px);
            background:#fff;
            border:1px solid var(--cinza-borda);
            border-radius:var(--radius);
            box-shadow:var(--shadow);
            min-width:180px;
            padding:8px 0;
            z-index:50;
        ">
            <div style="padding:10px 16px; font-size:14px; color:var(--texto-suave);">
                <p style="margin:0 0 4px;"><strong style="color:var(--texto);">UF:</strong> {{ $cidade->uf }}</p>
                <p style="margin:0;"><strong style="color:var(--texto);">CEP:</strong> {{ $cidade->cep }}</p>
            </div>
        </div>
    </div>

</div>

{{-- CARD EVENTOS --}}
<div style="
    background:#fff;
    border-radius:var(--radius);
    box-shadow:var(--shadow);
    overflow:hidden;
    border:1px solid var(--cinza-borda);
">

    <div style="
        background:var(--verde);
        color:#fff;
        padding:14px 24px;
        font-family:'Sora',sans-serif;
        font-size:15px;
        font-weight:600;
        letter-spacing:0.3px;
    ">
        📅 Agenda do Mês
    </div>

    <div style="padding:20px 24px;">

        @forelse($eventos as $evento)

            <div style="
                margin-bottom:16px;
                padding:20px;
                border:1px solid var(--cinza-borda);
                border-radius:var(--radius);
                background:var(--cinza-bg);
                transition:box-shadow 0.2s;
            " onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)'"
               onmouseout="this.style.boxShadow='none'">

                <h5 style="
                    font-family:'Sora',sans-serif;
                    font-size:16px;
                    font-weight:700;
                    color:var(--verde);
                    margin:0 0 14px;
                ">{{ $evento->nome }}</h5>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:4px 16px; margin-bottom:12px;">
                    <p style="margin:0; font-size:14px; color:var(--texto);">
                        <strong>📅 Data:</strong> {{ $evento->data }}
                    </p>
                    <p style="margin:0; font-size:14px; color:var(--texto);">
                        <strong>📍 Local:</strong> {{ $evento->local }}
                    </p>
                    <p style="margin:0; font-size:14px; color:var(--texto);">
                        <strong>⏰ Horário:</strong> {{ $evento->horario }}
                    </p>
                    <p style="margin:0; font-size:14px; color:var(--texto);">
                        <strong>🏷 Categoria:</strong> {{ $evento->categoria->nome ?? '-' }}
                    </p>
                </div>

                <p style="margin:0; font-size:14px; color:var(--texto-suave); line-height:1.6;">
                    {{ $evento->descricao }}
                </p>

            </div>

        @empty

            <div style="text-align:center; padding:48px 24px;">
                <p style="font-size:40px; margin-bottom:12px;">📭</p>
                <p style="color:var(--texto-suave); font-size:15px;">Nenhum evento encontrado para este mês.</p>
            </div>

        @endforelse

    </div>

</div>

@endsection

@push('scripts')
<script>
    function toggleDropdown() {
        const dd = document.getElementById('cidadeDropdown');
        dd.style.display = dd.style.display === 'none' ? 'block' : 'none';
    }

    document.addEventListener('click', function (e) {
        const wrapper = document.getElementById('cidadeDropdownWrapper');
        if (!wrapper.contains(e.target)) {
            document.getElementById('cidadeDropdown').style.display = 'none';
        }
    });
</script>
@endpush
