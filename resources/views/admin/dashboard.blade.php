@extends('admin.layout')
@section('titulo', 'Dashboard')

@push('styles')
<style>
    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 36px;
    }

    .card {
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--cinza);
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: var(--verde-claro);
    }

    .card-label {
        font-size: .78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: var(--muted);
        margin-bottom: 8px;
    }

    .card-value {
        font-family: 'Syne', sans-serif;
        font-size: 2.4rem;
        font-weight: 800;
        color: var(--verde);
        line-height: 1;
    }

    .section-title {
        font-family: 'Syne', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 16px;
        color: var(--texto);
    }

    .table-wrap {
        background: #fff;
        border-radius: 12px;
        border: 1px solid var(--cinza);
        overflow: hidden;
    }

    table { width: 100%; border-collapse: collapse; }

    thead th {
        background: var(--creme);
        padding: 12px 16px;
        text-align: left;
        font-size: .78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: var(--muted);
        border-bottom: 1px solid var(--cinza);
    }

    tbody td {
        padding: 13px 16px;
        font-size: .88rem;
        border-bottom: 1px solid var(--cinza);
    }

    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover { background: var(--creme); }

    .selo-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: .72rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .selo-organico    { background: #d4edda; color: #1a5e1a; }
    .selo-empresa     { background: #dbeafe; color: #1e3a8a; }
    .selo-autonomo    { background: #fef3c7; color: #78350f; }
    .selo-cooperativa { background: #ede9fe; color: #4c1d95; }
</style>
@endpush

@section('conteudo')
<div class="cards">
    <div class="card">
        <div class="card-label">Total de Usuários</div>
        <div class="card-value">{{ $totalUsuarios }}</div>
    </div>
    <div class="card">
        <div class="card-label">Total de Postagens</div>
        <div class="card-value">{{ $totalPostagens }}</div>
    </div>
</div>

<div class="section-title">Postagens recentes</div>
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Selo</th>
                <th>Postado por</th>
                <th>Data</th>
                <th>Preço/kg</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentPostagens as $p)
            <tr>
                <td>{{ $p->nome }}</td>
                <td><span class="selo-badge selo-{{ $p->selo }}">{{ $p->selo }}</span></td>
                <td>{{ $p->user?->name ?? '—' }}</td>
                <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
                <td>R$ {{ number_format($p->preco_kg, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center; color:var(--muted); padding:32px;">Nenhuma postagem ainda.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection