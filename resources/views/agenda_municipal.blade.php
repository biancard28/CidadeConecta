@extends('layouts.visitante')

@section('titulo', $cidade->nome . ' — Agenda Municipal')

@section('conteudo')

    <div style="
    max-width:1700px;
    margin:auto;
    padding:0 80px;
">

        {{-- HEADER --}}
        <div
            style="display:flex; justify-content:space-between; align-items:center; margin-bottom:28px; flex-wrap:wrap; gap:12px;">

            <div>
                <span
                    style="
                font-size:11px;
                font-weight:600;
                letter-spacing:2px;
                text-transform:uppercase;
                color:var(--verde);
                background:var(--verde-xlight);
                padding:4px 12px;
                border-radius:50px;
            ">Agenda
                    Municipal</span>

                <h2 style="font-size:28px; font-weight:700; margin-top:6px;">
                    Agenda da Cidade
                </h2>
            </div>

            <div style="position:relative;">

                <button onclick="toggleDropdown()"
                    style="
                display:flex;
                align-items:center;
                gap:8px;
                background:linear-gradient(90deg, var(--verde), #16a34a);
                color:#fff;
                border:none;
                padding:10px 18px;
                border-radius:50px;
                cursor:pointer;
                box-shadow:0 6px 16px rgba(0,0,0,0.15);
            ">
                    📍 {{ $cidade->nome }}
                </button>

                <div id="cidadeDropdown"
                    style="
                display:none;
                position:absolute;
                right:0;
                margin-top:8px;
                background:#fff;
                border-radius:10px;
                padding:14px;
                box-shadow:0 10px 30px rgba(0,0,0,0.15);
                min-width:250px;
                z-index:999;
            ">

                    {{-- BUSCA --}}
                    <input type="text" id="buscarCidade" placeholder="Buscar cidade..." onkeyup="filtrarCidades()"
                        style="
                        width:100%;
                        padding:8px;
                        border-radius:8px;
                        border:1px solid #e5e7eb;
                        margin-bottom:10px;
                    ">

                    {{-- LISTA DE CIDADES --}}
                    <div style="max-height:200px; overflow-y:auto;">

                        @foreach ($cidades as $c)
                            @if ($c->id == $cidade->id)
                                <div
                                    style="
                                display:block;
                                padding:6px;
                                border-radius:6px;
                                background:var(--verde);
                                color:#fff;
                                font-weight:600;
                                cursor:default;
                            ">
                                    📍 {{ $c->nome }} (Atual)
                                </div>
                            @else
                                <a href="{{ route('site.agenda_municipal', $c->id) }}"
                                    style="
                                    display:block;
                                    padding:6px;
                                    border-radius:6px;
                                    text-decoration:none;
                                    color:#111827;
                                ">
                                    {{ $c->nome }}
                                </a>
                            @endif
                        @endforeach

                    </div>

                    <hr style="margin:10px 0;">

                    {{-- 🔥 BOTÃO VOLTAR HOME --}}
                    <a href="{{ route('home') }}"
                        style="
                    display:block;
                    text-align:center;
                    background:#111827;
                    color:#fff;
                    padding:10px;
                    border-radius:10px;
                    text-decoration:none;
                    font-size:13px;
                    font-weight:600;
                ">
                        ⬅ Voltar para Home
                    </a>

                </div>

            </div>

        </div>

        {{-- CARD PRINCIPAL --}}
        <div
            style="
        background:#fff;
        border-radius:16px;
        border-left:5px solid var(--verde);
        box-shadow:0 15px 40px rgba(0,0,0,0.08);
        overflow:hidden;
    ">

            <div
                style="
            background:linear-gradient(90deg, var(--verde), #16a34a);
            color:#fff;
            padding:18px 24px;
            font-size:16px;
            font-weight:600;
        ">
                📅 Agenda do Mês
            </div>

            <div style="padding:28px; display:flex; gap:28px; align-items:flex-start;">

                {{-- FILTRO --}}
                <form method="GET"
                    style="
                width:240px;
                background:#fff;
                border-radius:14px;
                padding:18px;
                box-shadow:0 8px 20px rgba(0,0,0,0.06);
                border:1px solid #f1f5f9;
                position:sticky;
                top:20px;
            ">

                    <h4 style="margin-bottom:16px;font-size:14px;font-weight:700;">
                        🔎 Filtros
                    </h4>

                    <div style="margin-bottom:16px;">
                        <label style="font-size:12px;color:#6b7280;">Categoria</label>

                        <select name="categoria"
                            style="width:100%;margin-top:6px;padding:10px;border-radius:10px;border:1px solid #e5e7eb;">
                            <option value="">Todas</option>
                            @foreach ($categorias ?? [] as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ request('categoria') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label style="font-size:12px;color:#6b7280;">Período</label>

                        <input type="date" name="data_inicio" value="{{ request('data_inicio') }}"
                            style="width:100%;margin-top:6px;padding:10px;border-radius:10px;border:1px solid #e5e7eb;">

                        <input type="date" name="data_fim" value="{{ request('data_fim') }}"
                            style="width:100%;margin-top:8px;padding:10px;border-radius:10px;border:1px solid #e5e7eb;">
                    </div>

                    <div style="display:flex; gap:8px;">
                        <button type="submit"
                            style="flex:1;background:var(--verde);color:#fff;border:none;padding:10px;border-radius:10px;font-weight:600;">
                            Filtrar
                        </button>

                        <a href="{{ url()->current() }}"
                            style="flex:1;text-align:center;background:#f3f4f6;padding:10px;border-radius:10px;text-decoration:none;color:#111827;font-weight:600;">
                            Limpar
                        </a>
                    </div>

                </form>

                {{-- CALENDÁRIO --}}
                <div style="flex:1; min-width:600px;">
                    <div id="calendar"
                        style="
                    background:#fff;
                    border-radius:12px;
                    padding:32px;
                ">
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- MODAL --}}
    <div id="modal" onclick="fecharModalFora(event)"
        style="
        display:none;
        position:fixed;
        inset:0;
        background:rgba(0,0,0,0.65);
        justify-content:center;
        align-items:center;
        z-index:9999;
        padding:20px;
    ">

        <div
            style="
        background:#fff;
        width:1050px;
        max-width:98%;
        max-height:95vh;
        border-radius:20px;
        box-shadow:0 25px 70px rgba(0,0,0,0.35);
    ">

            <div
                style="
            background:linear-gradient(90deg, var(--verde), #16a34a);
            color:#fff;
            padding:22px 28px;
            border-radius:20px 20px 0 0;
        ">
                <h2 id="modalTitulo" style="margin:0;font-size:24px;"></h2>
            </div>

            <div style="padding:28px;font-size:15px;color:#374151;overflow-y: auto;max-height: 660px;">

                <div
                    style="
                    display:grid;
                    grid-template-columns:repeat(5, 1fr);
                    gap:14px;
                    margin-bottom:24px;
                ">

                    <div style="background:#f8fafc;padding:18px;border-radius:16px;">
                        <strong style="font-size:15px;"> Data</strong>
                        <p id="modalData" style="font-size:17px;margin:8px 0 0;font-weight:600;"></p>
                    </div>

                    <div style="background:#f8fafc;padding:18px;border-radius:16px;">
                        <strong style="font-size:15px;"> Hora</strong>
                        <p id="modalHora" style="font-size:17px;margin:8px 0 0;font-weight:600;"></p>
                    </div>

                    <div style="background:#f8fafc;padding:18px;border-radius:16px;">
                        <strong style="font-size:15px;"> Local</strong>
                        <p id="modalLocal" style="font-size:17px;margin:8px 0 0;font-weight:600;"></p>
                    </div>

                    <div style="background:#f8fafc;padding:18px;border-radius:16px;">
                        <strong style="font-size:15px;"> Categoria</strong>
                        <p id="modalCategoria" style="font-size:17px;margin:8px 0 0;font-weight:600;"></p>
                    </div>

                    <div style="background:#f8fafc;padding:18px;border-radius:16px;">
                        <strong style="font-size:15px;"> Recorrência</strong>
                        <p id="modalRecorrencia" style="font-size:17px;margin:8px 0 0;font-weight:600;"></p>
                    </div>

                </div>
                <hr style="margin:18px 0;">

                <h4 style="margin-bottom:8px;">Descrição</h4>
                <p id="modalDescricao" style="line-height:1.6;"></p>

                <div id="modalArquivoBox" style="display:none;margin-top:22px;">
                    <h4 style="margin-bottom:10px;">Arquivo anexado</h4>

                    <a id="modalArquivoLink" href="#" target="_blank"
                        style="
                        display:inline-flex;
                        align-items:center;
                        gap:8px;
                        background:#f3f4f6;
                        color:#111827;
                        padding:12px 16px;
                        border-radius:12px;
                        text-decoration:none;
                        font-weight:600;
                    ">
                        📎 Ver arquivo
                    </a>
                </div>

                <div id="modalImagensBox" style="display:none;margin-top:25px;">

                    <div id="modalImagens"
                        style="
                        display:grid;
                        grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
                        gap:16px;
                    ">
                    </div>

                </div>
                <div id="modalImagensBox" style="
        display:none;
        margin-top:30px;
    ">

                    <h4 style="
        margin-bottom:16px;
        font-size:18px;
        font-weight:700;
    ">
                        📸 Imagens do Evento
                    </h4>

                    <div id="modalImagens"
                        style="
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
            gap:18px;
        ">
                    </div>

                </div>

                <button onclick="fecharModal()"
                    style="
                    margin-top:28px;
                    width:100%;
                    background:var(--verde);
                    color:#fff;
                    padding:13px;
                    border:none;
                    border-radius:12px;
                    font-weight:700;
                    cursor:pointer;
                ">
                    Fechar
                </button>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @push('scripts')
        <script>
            const eventos = Object.values(@json($eventos));
            let currentDate = new Date();

            const urlParams = new URLSearchParams(window.location.search);
            const filtroCategoria = urlParams.get('categoria');
            const filtroInicio = urlParams.get('data_inicio');
            const filtroFim = urlParams.get('data_fim');

            function filtrarEventos(lista) {
                return Object.values(lista).filter(ev => {
                    if (filtroCategoria && ev.categoria_id != filtroCategoria) {
                        return false;
                    }

                    if (filtroInicio && ev.data < filtroInicio) return false;
                    if (filtroFim && ev.data > filtroFim) return false;

                    return true;
                });
            }

            function renderCalendar() {
                const calendar = document.getElementById("calendar");

                if (!calendar) return;

                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();

                const firstDay = new Date(year, month, 1).getDay();
                const lastDate = new Date(year, month + 1, 0).getDate();

                const monthNames = [
                    "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
                    "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
                ];

                const eventosFiltrados = filtrarEventos(eventos);

                let html = `
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                <button onclick="prevMonth()" style="padding:8px 14px;border:none;border-radius:8px;cursor:pointer;">◀</button>
                <strong style="font-size:22px;">${monthNames[month]} ${year}</strong>
                <button onclick="nextMonth()" style="padding:8px 14px;border:none;border-radius:8px;cursor:pointer;">▶</button>
            </div>

            <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:10px;">
        `;

                const days = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];

                days.forEach(d => {
                    html += `
                <div style="text-align:center;font-weight:700;font-size:14px;color:#111827;">
                    ${d}
                </div>
            `;
                });

                for (let i = 0; i < firstDay; i++) {
                    html += `<div></div>`;
                }

                for (let day = 1; day <= lastDate; day++) {
                    const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    const eventosDoDia = eventosFiltrados.filter(e => e.data === dateStr);

                    html += `
                <div style="min-height:150px;background:#f9fafb;border-radius:12px;padding:8px;border:1px solid #e5e7eb;">
                    <div style="text-align:right;font-weight:700;font-size:14px;margin-bottom:6px;">
                        ${day}
                    </div>
            `;

                    eventosDoDia.forEach(ev => {
                        html += `
                    <div onclick='abrirModal(${JSON.stringify(ev)})'
                        style="margin-top:5px;font-size:13px;background:var(--verde);color:#fff;padding:6px 8px;border-radius:8px;cursor:pointer;">
                        ${ev.nome}
                    </div>
                `;
                    });

                    html += `</div>`;
                }

                html += `</div>`;

                calendar.innerHTML = html;
            }

            function abrirModal(ev) {
                window.eventoAtual = ev;
                document.getElementById("modal").style.display = "flex";

                modalTitulo.innerText = ev.nome ?? '-';
                modalData.innerText = ev.data_formatada ?? '-';
                modalHora.innerText = "" + (ev.horario ?? '-');
                modalLocal.innerText = "" + (ev.local ?? '-');
                modalCategoria.innerText = "" + (ev.categoria?.nome ?? '-');
                modalDescricao.innerText = ev.descricao ?? '-';
                modalRecorrencia.innerText = ev.recorrencia ?? '-';

                function abrirImagem(url) {
    const imagensDiv = document.getElementById("modalImagens");

    imagensDiv.innerHTML = `
        <div style="text-align:center;">
            <img src="${url}"
                style="
                    max-width:100%;
                    max-height:70vh;
                    object-fit:contain;
                    background:#fff;
                    border-radius:18px;
                    box-shadow:0 10px 30px rgba(0,0,0,0.25);
                ">

            <button onclick="abrirModal(window.eventoAtual)"
                style="
                    margin-top:18px;
                    background:var(--verde);
                    color:#fff;
                    border:none;
                    padding:12px 24px;
                    border-radius:12px;
                    font-weight:700;
                    cursor:pointer;
                ">
                ⬅ Voltar
            </button>
        </div>
    `;
}

                const arquivoBox = document.getElementById("modalArquivoBox");
                const arquivoLink = document.getElementById("modalArquivoLink");

                if (arquivoBox && arquivoLink) {
                    if (ev.arquivo_url) {
                        arquivoBox.style.display = "block";
                        arquivoLink.href = ev.arquivo_url;
                    } else {
                        arquivoBox.style.display = "none";
                        arquivoLink.href = "#";
                    }
                }

                const imagensBox = document.getElementById("modalImagensBox");
                const imagensDiv = document.getElementById("modalImagens");

                if (imagensBox && imagensDiv) {
                    imagensDiv.innerHTML = "";

                    if (ev.imagens_formatadas && ev.imagens_formatadas.length > 0) {
                        imagensBox.style.display = "block";

                        ev.imagens_formatadas.forEach(img => {
                                imagensDiv.innerHTML += `
                        <img src="${img.url}"
                            onclick="abrirImagem('${img.url}')"
                            style="
                                width:100%;
                                height:360px;
                                object-fit:contain;
                                background:#f8fafc;
                                border-radius:16px;
                                box-shadow:0 10px 25px rgba(0,0,0,0.18);
                                cursor:zoom-in;
                            ">
                    `;
                        });
                    } else {
                        imagensBox.style.display = "none";
                    }
                }
            }

            function fecharModal() {
                document.getElementById("modal").style.display = "none";
            }

            function prevMonth() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            }

            function nextMonth() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            }

            function toggleDropdown() {
                let el = document.getElementById('cidadeDropdown');
                el.style.display = el.style.display === 'block' ? 'none' : 'block';
            }

            function filtrarCidades() {
                let input = document.getElementById('buscarCidade');
                let filtro = input.value.toLowerCase();
                let links = document.querySelectorAll('#cidadeDropdown a');

                links.forEach(link => {
                    link.style.display = link.innerText.toLowerCase().includes(filtro) ? 'block' : 'none';
                });
            }

            function fecharModalFora(event) {
    if (event.target.id === "modal") {
        fecharModal();
    }
}

            document.addEventListener("DOMContentLoaded", renderCalendar);
        </script>
        <style>
            #modal>div::-webkit-scrollbar {
                width: 7px;
            }

            #modal>div::-webkit-scrollbar-track {
                background: #ecfdf5;
                border-radius: 20px;
            }

            #modal>div::-webkit-scrollbar-thumb {
                background: var(--verde);
                border-radius: 20px;
            }

            #modal>div::-webkit-scrollbar-thumb:hover {
                background: #16a34a;
            }

            #modal>div {
                scrollbar-width: thin;
                scrollbar-color: var(--verde) #ecfdf5;
            }
        </style>
    @endpush
