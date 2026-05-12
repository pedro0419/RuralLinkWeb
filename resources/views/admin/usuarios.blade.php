@extends('admin.layout')
@section('titulo', 'Usuários')

@push('styles')
<style>
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

    .role-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: .72rem;
        font-weight: 600;
    }

    .role-admin { background: var(--verde); color: #fff; }
    .role-user  { background: var(--cinza); color: var(--muted); }

    .btn-danger {
        background: var(--danger);
        color: #fff;
        border: none;
        padding: 6px 14px;
        border-radius: 6px;
        font-size: .8rem;
        font-weight: 600;
        cursor: pointer;
        transition: opacity .15s;
    }

    .btn-danger:hover { opacity: .85; }

    .pagination-wrap {
        padding: 16px;
        display: flex;
        justify-content: flex-end;
    }

    .pagination-wrap .pagination {
        display: flex;
        gap: 4px;
        list-style: none;
    }

    .pagination-wrap .pagination li a,
    .pagination-wrap .pagination li span {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: .82rem;
        border: 1px solid var(--cinza);
        color: var(--texto);
        text-decoration: none;
        background: #fff;
    }

    .pagination-wrap .pagination li.active span {
        background: var(--verde);
        color: #fff;
        border-color: var(--verde);
    }
</style>
@endpush

@section('conteudo')

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

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Role</th>
                <th>Postagens</th>
                <th>Cadastro</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $u)
            <tr>
                <td style="color:var(--muted);">{{ $u->id }}</td>
                <td><strong>{{ $u->name }}</strong></td>
                <td>{{ $u->email }}</td>
                <td><span class="role-badge role-{{ $u->role }}">{{ $u->role }}</span></td>
                <td>{{ $u->postagens_count }}</td>
                <td>{{ $u->created_at->format('d/m/Y') }}</td>
                <td>
                    @if($u->role !== 'admin')
                    <form method="POST" action="{{ route('admin.banir', $u->id) }}"
                          onsubmit="return confirm('Remover usuário {{ $u->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">Banir</button>
                    </form>
                    @else
                    <span style="color:var(--muted); font-size:.8rem;">—</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center; color:var(--muted); padding:32px;">Nenhum usuário.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-wrap">
        {{ $usuarios->links() }}
    </div>
</div>
@endsection