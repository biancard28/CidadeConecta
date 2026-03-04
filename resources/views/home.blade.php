@extends('layout')

@section('conteudo')

<!-- Seção de boas-vindas -->
<section class="welcome" style="text-align:center; margin-bottom:40px;">
    <h1>Bem-Vindo à Cidade Conecta</h1>
    <p>Informações, serviços e eventos da nossa cidade em um só lugar.</p>
</section>

<!-- Seção de eventos -->
<section class="eventos">
    <h2>Próximos Eventos e Serviços</h2>

    <div class="cards" style="display:flex; flex-wrap:wrap; gap:20px; justify-content:center;">

        <!-- Evento de coleta de lixo -->
        <div class="card" style="border:1px solid #ccc; padding:20px; width:250px; border-radius:8px;">
            <h3>Coleta de Lixo</h3>
            <p>Próxima coleta: 05/03/2026</p>
            <p>Bairros atendidos: Centro, Vila Nova e Jardim das Flores</p>
        </div>

        <!-- Evento cultural -->
        <div class="card" style="border:1px solid #ccc; padding:20px; width:250px; border-radius:8px;">
            <h3>Festa da Primavera</h3>
            <p>Data: 12/03/2026</p>
            <p>Local: Praça Central</p>
            <p>Shows, barraquinhas e atividades para toda a família!</p>
        </div>

        <!-- Evento esportivo -->
        <div class="card" style="border:1px solid #ccc; padding:20px; width:250px; border-radius:8px;">
            <h3>Corrida da Cidade</h3>
            <p>Data: 20/03/2026</p>
            <p>Percurso: 5km no centro e parques</p>
        </div>

        <!-- Evento educacional -->
        <div class="card" style="border:1px solid #ccc; padding:20px; width:250px; border-radius:8px;">
            <h3>Oficinas de Arte</h3>
            <p>Data: 15/03/2026</p>
            <p>Local: Centro Cultural</p>
            <p>Atividades gratuitas para crianças e adultos</p>
        </div>

    </div>
</section>

<!-- Seção de contato / informações importantes -->
<section class="informacoes" style="margin-top:40px; text-align:center;">
    <h2>Informações Úteis</h2>
    <ul style="list-style:none; padding:0;">
        <li>Prefeitura de Cidade Conecta | Rua Exemplo, 123 - Centro</li>
        <li>Telefone: (00) 1234-5678 | Email: contato@cidadeconecta.gov.br</li>
        <li>Horário de atendimento: Segunda a sexta, 08h às 17h</li>
    </ul>
</section>

@endsection
