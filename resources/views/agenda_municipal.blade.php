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
                                <a href="{{ route('cidades.show', $c->id) }}"
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
    <div id="modal"
        style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);justify-content:center;align-items:center;">
        <div style="background:#fff;padding:24px;border-radius:14px;width:400px;">
            <h3 id="modalTitulo"></h3>
            <p id="modalData"></p>
            <p id="modalHora"></p>
            <p id="modalLocal"></p>
            <p id="modalCategoria"></p>
            <p id="modalDescricao"></p>

            <button onclick="fecharModal()"
                style="margin-top:14px;width:100%;background:var(--verde);color:#fff;padding:10px;border:none;border-radius:10px;">
                Fechar
            </button>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const eventos = @json($eventos);
        let currentDate = new Date();

        /* FILTROS */
        const urlParams = new URLSearchParams(window.location.search);
        const filtroCategoria = urlParams.get('categoria');
        const filtroInicio = urlParams.get('data_inicio');
        const filtroFim = urlParams.get('data_fim');

        function filtrarEventos(lista) {
            return lista.filter(ev => {

                if (filtroCategoria && filtroCategoria !== "" && ev.categoria_id != filtroCategoria) {
                    return false;
                }

                if (filtroInicio && ev.data < filtroInicio) return false;
                if (filtroFim && ev.data > filtroFim) return false;

                return true;
            });
        }

        /* CALENDÁRIO */
        function renderCalendar() {

            const calendar = document.getElementById("calendar");
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();

            const monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho",
                "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
            ];

            const eventosFiltrados = filtrarEventos(eventos);

            let html = `
        <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
            <button onclick="prevMonth()">◀</button>
            <strong>${monthNames[month]} ${year}</strong>
            <button onclick="nextMonth()">▶</button>
        </div>

        <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:10px;">
    `;

            const days = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];

            days.forEach(d => {
                html += `<div style="text-align:center;font-weight:600;font-size:13px;">${d}</div>`;
            });

            for (let i = 0; i < firstDay; i++) html += `<div></div>`;

            for (let day = 1; day <= lastDate; day++) {

                const dateStr = `${year}-${String(month+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
                const eventosDoDia = eventosFiltrados.filter(e => e.data === dateStr);

                html += `
            <div style="min-height:150px;background:#f9fafb;border-radius:10px;padding:6px;">
                <div style="text-align:right;font-weight:600;font-size:13px;">${day}</div>
        `;

                eventosDoDia.forEach(ev => {
                    html += `
                <div onclick='abrirModal(${JSON.stringify(ev)})'
                style="margin-top:4px;font-size:13px;background:var(--verde);color:#fff;padding:3px 6px;border-radius:6px;cursor:pointer;">
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
            document.getElementById("modal").style.display = "flex";
            modalTitulo.innerText = ev.nome;
            modalData.innerText = "📅 " + ev.data;
            modalHora.innerText = "⏰ " + ev.horario;
            modalLocal.innerText = "📍 " + ev.local;
            modalCategoria.innerText = "🏷 " + (ev.categoria?.nome ?? '-');
            modalDescricao.innerText = ev.descricao;
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

        renderCalendar();
    </script>
@endpush
