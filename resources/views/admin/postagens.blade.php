@extends('admin.layout')
@section('titulo', 'Postagens')
@use('Illuminate\Support\Facades\Storage')

@push('styles')
<style>
    .filtros {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .filtros input, .filtros select {
        padding: 9px 14px;
        border: 1px solid var(--cinza);
        border-radius: 8px;
        font-size: .88rem;
        font-family: 'DM Sans', sans-serif;
        background: #fff;
        color: var(--texto);
        outline: none;
    }

    .filtros input:focus, .filtros select:focus {
        border-color: var(--verde-claro);
    }

    .btn-filtrar {
        background: var(--verde);
        color: #fff;
        border: none;
        padding: 9px 20px;
        border-radius: 8px;
        font-size: .88rem;
        font-weight: 600;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
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
        vertical-align: middle;
    }

    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover { background: var(--creme); }

    .foto-thumb {
        width: 44px;
        height: 44px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid var(--cinza);
    }

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

    .btn-danger {
        background: var(--danger);
        color: #fff;
        border: none;
        padding: 6px 14px;
        border-radius: 6px;
        font-size: .8rem;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-danger:hover { opacity: .85; }

    .pagination-wrap {
        padding: 16px;
        display: flex;
        justify-content: flex-end;
    }
</style>
@endpush

@section('conteudo')

@if(session('erro'))
<div style="
    display: flex;
    align-items: flex-start;
    gap: 12px;
    background: #fff5f5;
    border: 1px solid #f09595;
    border-left: 4px solid #E24B4A;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 20px;
    font-size: .88rem;
    color: #7a1f1f;
">
    ⚠️ {{ session('erro') }}
</div>
@endif

@if(session('sucesso'))
<div style="
    background: #f0fdf4;
    border: 1px solid #97c459;
    border-left: 4px solid #3B6D11;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 20px;
    font-size: .88rem;
    color: #1a3d08;
">
    ✓ {{ session('sucesso') }}
</div>
@endif

<form method="GET" action="{{ route('admin.postagens') }}" class="filtros">
    <input type="text" name="busca" placeholder="Buscar produto..." value="{{ request('busca') }}">
    <select name="selo">
        <option value="">Todos os selos</option>
        @foreach(['organico','empresa','autonomo','cooperativa'] as $s)
        <option value="{{ $s }}" {{ request('selo') === $s ? 'selected' : '' }}>
            {{ ucfirst($s) }}
        </option>
        @endforeach
    </select>
    <button type="submit" class="btn-filtrar">Filtrar</button>
</form>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Produto</th>
                <th>Selo</th>
                <th>Preço/kg</th>
                <th>Qtd (kg)</th>
                <th>Postado por</th>
                <th>Data</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @forelse($postagens as $p)
            <tr>
                <td>
                    <img src="{{ Storage::disk('s3')->url($p->foto) }}" alt="{{ $p->nome }}" class="foto-thumb"
                    onerror="this.onerror=null;this.src='{{ asset('assets/imgvazio.png') }}'">
                </td>
                <td><strong>{{ $p->nome }}</strong></td>
                <td><span class="selo-badge selo-{{ $p->selo }}">{{ $p->selo }}</span></td>
                <td>R$ {{ number_format($p->preco_kg, 2, ',', '.') }}</td>
                <td>{{ number_format($p->quantidade, 2, ',', '.') }}</td>
                <td>{{ $p->user?->name ?? '—' }}</td>
                <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.excluir-postagem', $p->id) }}"
                          onsubmit="return confirm('Excluir postagem {{ $p->nome }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center; color:var(--muted); padding:32px;">Nenhuma postagem encontrada.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection