@extends('layouts.visitante')

@section('titulo', $cidade->nome . ' — Agenda Municipal')

@section('conteudo')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:28px; flex-wrap:wrap; gap:12px;">

    <div>
        <span style="
            font-size:11px;
            font-weight:600;
            letter-spacing:2px;
            text-transform:uppercase;
            color:var(--verde);
            background:var(--verde-xlight);
            padding:4px 12px;
            border-radius:50px;
        ">Agenda Municipal</span>

        <h2 style="font-size:26px; font-weight:700; margin-top:6px;">
            Agenda da Cidade
        </h2>
    </div>

    {{-- BOTÃO CIDADE --}}
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
            cursor:pointer;
        ">
            📍 {{ $cidade->nome }}
        </button>

        <div id="cidadeDropdown" style="
            display:none;
            position:absolute;
            right:0;
            background:#fff;
            border:1px solid #ddd;
            border-radius:8px;
            padding:10px;
        ">
            <p><strong>UF:</strong> {{ $cidade->uf }}</p>
            <p><strong>CEP:</strong> {{ $cidade->cep }}</p>
        </div>
    </div>

</div>

{{-- CARD --}}
<div style="background:#fff; border-radius:12px; border:1px solid #e5e7eb;">

    <div style="background:var(--verde); color:#fff; padding:14px 20px;">
        📅 Agenda do Mês
    </div>

    <div style="padding:20px; display:flex; gap:24px; align-items:flex-start;">

        {{-- FILTRO --}}
        <form method="GET" style="
            width:280px;
            background:linear-gradient(180deg, #fff, #f9fafb);
            border:1px solid #e5e7eb;
            border-radius:14px;
            padding:18px;
            box-shadow:0 6px 18px rgba(0,0,0,0.06);
            position:sticky;
            top:20px;
        ">

            <h4 style="margin-bottom:16px; font-size:14px; font-weight:700;">
                🔎 Filtros
            </h4>

            {{-- CATEGORIA --}}
            <div style="margin-bottom:16px;">
                <label style="font-size:12px; color:#6b7280;">Categoria</label>

                <select name="categoria" style="
                    width:100%;
                    margin-top:6px;
                    padding:10px;
                    border-radius:10px;
                    border:1px solid #e5e7eb;
                    background:#fff;
                ">
                    <option value="">📌 Todas as categorias</option>

                    @foreach($categorias ?? [] as $cat)
                        <option value="{{ $cat->id }}"
                            {{ request('categoria') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- PERÍODO --}}
            <div style="margin-bottom:16px;">
                <label style="font-size:12px; color:#6b7280;">Período</label>

                <input type="date" name="data_inicio"
                    value="{{ request('data_inicio') }}"
                    style="width:100%; margin-top:6px; padding:10px; border-radius:10px; border:1px solid #e5e7eb;">

                <input type="date" name="data_fim"
                    value="{{ request('data_fim') }}"
                    style="width:100%; margin-top:8px; padding:10px; border-radius:10px; border:1px solid #e5e7eb;">
            </div>

            <div style="display:flex; gap:8px;">
                <button type="submit" style="
                    flex:1;
                    background:var(--verde);
                    color:#fff;
                    border:none;
                    padding:10px;
                    border-radius:10px;
                    font-weight:600;
                    cursor:pointer;
                ">Filtrar</button>

                <a href="{{ url()->current() }}" style="
                    flex:1;
                    text-align:center;
                    background:#f3f4f6;
                    padding:10px;
                    border-radius:10px;
                    text-decoration:none;
                    color:#111827;
                    font-weight:600;
                ">Limpar</a>
            </div>

        </form>

        {{-- CALENDÁRIO --}}
        <div style="flex:1;">
            <div id="calendar" style="
                background:#fff;
                border:1px solid #e5e7eb;
                border-radius:10px;
                padding:16px;
            "></div>
        </div>

    </div>
</div>

{{-- MODAL --}}
<div id="modal" style="
    display:none;
    position:fixed;
    top:0; left:0;
    width:100%; height:100%;
    background:rgba(0,0,0,0.5);
    justify-content:center;
    align-items:center;
">
    <div style="background:#fff; padding:20px; border-radius:12px; width:400px;">
        <h3 id="modalTitulo"></h3>
        <p id="modalData"></p>
        <p id="modalHora"></p>
        <p id="modalLocal"></p>
        <p id="modalCategoria"></p>
        <p id="modalDescricao"></p>

        <button onclick="fecharModal()" style="
            margin-top:10px;
            background:var(--verde);
            color:#fff;
            padding:10px;
            border:none;
            border-radius:8px;
            cursor:pointer;
        ">Fechar</button>
    </div>
</div>

@endsection

@push('scripts')

<script>

const eventos = @json($eventos);
let currentDate = new Date();

function renderCalendar() {

    const calendar = document.getElementById("calendar");
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();

    const monthNames = ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho",
    "Agosto","Setembro","Outubro","Novembro","Dezembro"];

    let html = `
        <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
            <button onclick="prevMonth()">◀</button>
            <strong>${monthNames[month]} ${year}</strong>
            <button onclick="nextMonth()">▶</button>
        </div>

        <div style="display:grid; grid-template-columns:repeat(7,1fr); gap:8px;">
    `;

    const days = ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'];

    days.forEach(d => {
        html += `<div style="text-align:center; font-weight:600;">${d}</div>`;
    });

    for (let i = 0; i < firstDay; i++) html += `<div></div>`;

    for (let day = 1; day <= lastDate; day++) {

        const dateStr = `${year}-${String(month+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;

        const eventosDoDia = eventos.filter(e => e.data === dateStr);

        html += `
            <div style="
                height:90px;
                background:#f9fafb;
                border:1px solid #e5e7eb;
                border-radius:8px;
                padding:6px;
                display:flex;
                flex-direction:column;
            ">
                <div style="text-align:right; font-weight:600;">${day}</div>
        `;

        eventosDoDia.forEach(ev => {
            html += `
                <div onclick='abrirModal(${JSON.stringify(ev)})'
                style="
                    margin-top:4px;
                    font-size:11px;
                    background:var(--verde);
                    color:#fff;
                    padding:2px 4px;
                    border-radius:4px;
                    cursor:pointer;
                ">
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
